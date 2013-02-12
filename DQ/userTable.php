<?php

class UserTable extends Doctrine_Table
{
    const BANK_ID = 2;
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('User');
    }

    public function getLoginUser($params = array())
    {
        return $this->createQuery()
                    ->from('User')
                    ->select('id, is_active')
                    ->addWhere('username = ?', $params['username'])
                    ->addWhere('password = ?', $params['password'])
                    ->whereNotIn('id', array(self::BANK_ID));
    }
    
    /*public function getRoleByName($params = array())
    {
        return $this->createQuery()
                    ->from('User u')
                    ->leftJoin('u.UserRole ur')
                    ->leftJoin('ur.Role r')
                    ->addWhere('r.name = ?', $params['role']);
    }*/
    
    public function getRoles($params = array())
    {
        return $this->createQuery()
                    ->select('r.*')
                    ->from('Role r')
                    ->leftJoin('r.UserRole ur')
                    ->addWhere('ur.user_id = ?', $params['user_id']);
    }
    
    public function chkUsername($params = array())
    {
        return $this->createQuery()
                    ->select('id')
                    ->addWhere('username = ?', $params['username']);
    }
    
    public function getRandomParent($params = array())
    {
        return $this->createQuery()
                    ->from('User u')
                    ->leftJoin('u.Roles r')
                    ->select('u.id')
                    ->addWhere('r.name = ?', 'USER')
                    ->addWhere('u.is_active = 1')
                    ->orderBy('rand()');
    }
    
    public function getParentByRef($params = array())
    {
        return $this->createQuery()
                    ->from('User u')
                    ->leftJoin('u.Roles r')
                    ->select('u.id')
                    ->addWhere('r.name = ?', 'USER')
                    ->addWhere('u.is_active = 1')
                    ->addWhere('u.ref_id = ?', $params['ref_id']);
    }
    
    /*
     * Activation check
     */
    public function activation($params = array())
    {
        return $this->createQuery()
                    ->from('User u')
                    ->addWhere('u.is_active = 0')
                    ->addWhere('u.ref_id = ?', $params['code']);
    }
    
    /*
     * Get children of a parent
     */
    
    public function getChildrenByParentId($params = array())
    {
        return $this->createQuery()
                        ->from('User u')
                        ->addWhere('u.is_active = 1')
                        ->addWhere('u.parent_id = ?', $params['parent_id']);
    }
    
    public function queryAddActiveUsers($q)
    {
        return $q->addWhere('u.is_active = 1');
    }
    
    /*
     * 
     * Here we have to use raw sql, not the dql
     * 
     * This function return {{$level}} levels up (parents)
     * 
     * parent_id is the one to use
     * 
     */
    
    public function getAscendents($params = array(), $level = 2)
    {
        //this query dont need any mysql functions
        $query = 'SELECT  @r AS _id,
                             (
                             SELECT  @r := parent_id
                             FROM    user
                             WHERE   id = _id
                             ) AS parent_id,
                             @l := @l + 1 AS lvl
                     FROM    (
                             SELECT  @r := :user_id,
                                     @l := 0,
                                     @cl := 0
                             ) vars,
                             user h
                    WHERE    @r <> 0  AND @l <= :level';
        
        $conn = $this->getConnection();
        $result = $conn->execute($query, array('user_id' => $params['user_id'], 'level' => $level));
        //$result->setFetchMode(Doctrine_Core::FETCH_ASSOC);
        
        return $result->fetchAll();
    }
    
    /*
     * 
     * Here we have to use raw sql, not the dql
     * 
     * This function return {{$level}} levels down
     * 
     * parent_id is the one to use
     * 
     * 
     * MySql function for this query to work
     * 
     * CREATE FUNCTION `hierarchy_connect_by_parent_eq_prior_id_with_level`(`value` INT, `maxlevel` INT)
        RETURNS int(11)
        LANGUAGE SQL
        NOT DETERMINISTIC
        READS SQL DATA
        SQL SECURITY DEFINER
        COMMENT ''
        BEGIN
                DECLARE _id INT;
                DECLARE _parent INT;
                DECLARE _next INT;
                DECLARE _i INT;
                DECLARE CONTINUE HANDLER FOR NOT FOUND SET @id = NULL;

                SET _parent = @id;
                SET _id = -1;
                SET _i = 0;

                IF @id IS NULL THEN
                        RETURN NULL;
                END IF;

                LOOP
                        SELECT  MIN(id)
                        INTO    @id
                        FROM    user
                        WHERE   parent_id = _parent
                                AND id > _id
                                AND COALESCE(@level < maxlevel, TRUE);
                        IF @id IS NOT NULL OR _parent = @start_with THEN
                                SET @level = @level + 1;
                                RETURN @id;
                        END IF;
                        SET @level := @level - 1;
                        SELECT  id, parent_id
                        INTO    _id, _parent
                        FROM    user
                        WHERE   id = _parent;
                        SET _i = _i + 1;
                END LOOP;
                RETURN NULL;
        END
     */
    
    public function getDescendents($params = array(), $level = 2)
    {
        //this query need a mysql function
        $query = 'SELECT  /*CONCAT(REPEAT("----", level - 1), CAST(hi.username AS CHAR)) AS treeitem hi.id AS treeitem*/ hi.username, parent_id, level, hi.id
                    FROM    (
                            SELECT  hierarchy_connect_by_parent_eq_prior_id_with_level(id, :level) AS id, @level AS level
                            FROM    (
                                    SELECT  @start_with := :user_id,
                                            @id := @start_with,
                                            @level := 0
                                    ) vars, user
                            WHERE   @id IS NOT NULL
                            ) ho
                    JOIN    user hi
                    ON      hi.id = ho.id
                    ';
        
        $conn = $this->getConnection();
        $result = $conn->execute($query, array('user_id' => $params['user_id'], 'level' => $level));
        //$result->setFetchMode(Doctrine_Core::FETCH_ASSOC);
        
        return $result->fetchAll();
    }
    
    public function getDescendentsNumbers($params = array(), $level = 2)
    {
        //this query need a mysql function
        $query = 'SELECT  hi.username, parent_id, level, hi.id, COUNT(hi.id) AS no
                    FROM    (
                            SELECT  hierarchy_connect_by_parent_eq_prior_id_with_level(id, :level) AS id, @level AS level
                            FROM    (
                                    SELECT  @start_with := :user_id,
                                            @id := @start_with,
                                            @level := 0
                                    ) vars, user
                            WHERE   @id IS NOT NULL
                            ) ho
                    JOIN    user hi
                    ON      hi.id = ho.id
                    GROUP BY level';
        
        $conn = $this->getConnection();

        $result = $conn->execute($query, array('user_id' => $params['user_id'], 'level' => $level));
        //$result->setFetchMode(Doctrine_Core::FETCH_ASSOC);
        
        return $result->fetchAll();
    }

    /*
     * Yet another complicated query
     * 
     * This query will return all ascendents and descendents based on level (this query can be used whitout a level, tho that will return all rows)
     * 
     */
    
    public function getAscDesc($params, $level)
    {
        $query = 'SELECT  CONCAT(REPEAT("----", level - 1), CAST(id AS CHAR)) as treeitem, id,
                            parent_id,
                            level
                    FROM    (
                            SELECT  id, parent_id, IF(ancestry, @cl := @cl + 1, level + @cl) AS level
                            FROM    (
                                    SELECT  TRUE AS ancestry, _id AS id, parent_id, level
                                    FROM    (
                                            SELECT  @r AS _id,
                                                    (
                                                    SELECT  @r := parent_id
                                                    FROM    user
                                                    WHERE   id = _id
                                                    ) AS parent_id,
                                                    @l := @l + 1 AS level
                                            FROM    (
                                                    SELECT  @r := :user_id,
                                                            @l := 0,
                                                            @cl := 0
                                                    ) vars,
                                                    user h
                                            WHERE   @r <> 0 and @l <= :level
                                            ORDER BY
                                                    level DESC
                                            ) qi
                                    UNION ALL
                                    SELECT  FALSE, hi.id, parent_id, level
                                    FROM    (
                                            SELECT  hierarchy_connect_by_parent_eq_prior_id_with_level(id, :level) AS id, @level AS level
                                            FROM    (
                                                    SELECT  @start_with := :user_id,
                                                            @id := @start_with,
                                                            @level := 0
                                                    ) vars, user
                                            WHERE   @id IS NOT NULL
                                            ) ho
                                    JOIN    user hi
                                    ON      hi.id = ho.id
                                    ) q
                            ) q2';
        
        $conn = $this->getConnection();
        $result = $conn->execute($query, array('user_id' => $params['user_id'], 'level' => $level));
        
        return $result->fetchAll();
    }
    
    
    /* Only if later needed  */
    /*
         * MySql function adding ancestry chains.
         * 
         * DELIMITER //
            CREATE FUNCTION hierarchy_sys_connect_by_path(delimiter TEXT, node INT) RETURNS TEXT
            NOT DETERMINISTIC
            READS SQL DATA
            BEGIN
                 DECLARE _path TEXT;
             DECLARE _cpath TEXT;
                    DECLARE _id INT;
                DECLARE EXIT HANDLER FOR NOT FOUND RETURN _path;
                SET _id = COALESCE(node, @id);
                  SET _path = _id;
                LOOP
                            SELECT  parent_id
                          INTO    _id
                     FROM    user
                     WHERE   id = _id
                                AND COALESCE(id <> @start_with, TRUE);
                          SET _path = CONCAT(_id, delimiter, _path);
              END LOOP;
            END
         * 
         */
    /*
     * Using in a query
     * 
     * SELECT  CONCAT(REPEAT('       ', level - 1), hi.id) AS treeitem,
                hierarchy_sys_connect_by_path('/', hi.id) AS path,
                parent_id, level
        FROM    (
                SELECT  hierarchy_connect_by_parent_eq_prior_id_with_level(id, 8) AS id,
                        CAST(@level AS SIGNED) AS level
                FROM    (
                        SELECT  @start_with := 1,
                                @id := @start_with,
                                @level := 0
                        ) vars, user
                WHERE   @id IS NOT NULL
                ) ho
        JOIN    user hi
        ON      hi.id = ho.id

     */

    public function getUsers($params = array(), $fields = array())
    {
        $query = $this->createQuery();
        if(count($fields)) {
            $select = implode(',', $fields);
            $query->addSelect($select);
        }
        
        return $query;
    }
    
    public function getUsersByRole($params = array())
    {
        return $this->createQuery()
                ->select('u.*, COUNT(u.id) c')
                ->from('User u')
                ->innerJoin('u.UserRole ur')
                ->innerJoin('ur.Role r')
								->addSelect('r.name as rolename')
                ->where('u.is_active = 1')
                ->whereIn('r.name', $params['roleIn'])
                ->groupBy('u.id')/*
                ->having('c = 1')*/;
    }
    
    public function getUsersNotActivated($params = array(), $fields = array())
    {
        $query = $this->createQuery();
        if(count($fields)) {
            $select = implode(',', $fields);
            $query->addSelect($select);
        }
        $query->where('is_active = 0');
        return $query;
    }
    
    public function getUsersByMRequest($params = array(), $fields = array())
    {
        $query = $this->createQuery();
        if(count($fields)) {
            $select = implode(',', $fields);
            $query->addSelect($select);
        }
        $query->where('is_active = 1')
                ->addWhere('request_step > 0')
                ->addWhere('request_step < 100');;
        return $query;
    }
		
    public function getRegistrationStatistic($params = array(), $type = 'daily')
    {
        if($type === 'daily') {
            return $this->createQuery()
                    ->addSelect('day(created_at) AS d, count(month(created_at)) AS total')
                    ->addWhere('month(created_at) = ?', $params['month'])
                    ->addWhere('year(created_at) = ?', $params['year'])
                    ->groupBy('d')
                    ->execute(array(), Doctrine::HYDRATE_ARRAY);
        }
        
        if($type === 'monthly') {
            return $this->createQuery()
                    ->addSelect('month(created_at) AS m, count(month(created_at)) AS total')
                    ->addWhere('year(created_at) = ?', $params['year'])
                    ->groupBy('m')
                    ->execute(array(), Doctrine::HYDRATE_ARRAY);
        }
        
    }
    
    public function getNewsletter($params = array())
    {
        return $this->createQuery()
                    ->addSelect('email')
                    ->execute(array(), Doctrine::HYDRATE_ARRAY);
    }
    
    public function getMercCompany($user_id)
    {
        return $this->createQuery('u')
                ->leftJoin('u.Company c')
                ->addWhere('c.company_type = 1')
                ->addWhere('c.user_id = ?', $user_id)
                ->execute(array(), Doctrine::HYDRATE_ARRAY);
    }
		
		public function getUserGroup($user_id) {
			//gold
			$children = array();
			$users = Doctrine_Query::create()
							->select('id, parent_id')
							->from('User u')
							->addWhere('created_at > ADDDATE(CURDATE(), INTERVAL -120 DAY)')
							->addWhere('parent_id != 0')
							->fetchArray();
			foreach ($users as $user) {
				$children[$user['parent_id']][] = $user['id'];
			}
			if (count($children[$user_id]) >= 1) {
				$add = true;
				foreach ($children[$user_id] as $c) {
					if (count($children[$c]) < 1) {
						$add = false;
						break;
					}
				}
				if ($add) return 'gold';
			}
			//silver
			$children = array();
			$users = Doctrine_Query::create()
							->select('id, parent_id,')
							->from('User u')
							->addWhere('created_at > ADDDATE(CURDATE(), INTERVAL -150 DAY)')
							->addWhere('parent_id != 0')
							->fetchArray();
			foreach ($users as $user) {
				$children[$user['parent_id']][] = $user['id'];
			}
			if (count($children[$user_id]) >= 1) {
				$add = true;
				foreach ($children[$user_id] as $c) {
					if (count($children[$c]) < 1) {
						$add = false;
						break;
					}
				}
				if ($add) return 'silver';
			}
			//bronze
			$children = array();
			$users = Doctrine_Query::create()
								->select('id, parent_id')
								->from('User u')
								->addWhere('created_at > ADDDATE(CURDATE(), INTERVAL -210 DAY)')
								->addWhere('parent_id != 0')
								->fetchArray();
			foreach ($users as $user) {
				$children[$user['parent_id']][] = $user['id'];
			}
			if (count($children[$user_id]) >= 1) {
				$add = true;
				foreach ($children[$user_id] as $c) {
					if (count($children[$c]) < 1) {
						$add = false;
						break;
					}
				}
				if ($add) return 'bronze';
			}
			
			return '';
		}
}
