
<?php

class Transaksidb_model extends CI_Model
{
    /**
     * construct connetion database.
     * reload table users.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert($tableName, array $data = null)
    {
        if ($data) {
            $this->db->insert($tableName, $data);
            return $this->db->insert_id();
        } else {
            return null;
        }
    }

    public function insert_bulk($tableName, array $data = null)
    {
        if ($data) {
            $this->db->insert_batch($tableName, $data);
            return $this->db->insert_id();
        } else {
            return null;
        }
    }

    public function update($tableName, $wherefieldname, $id, array $data = null)
    {

        if ($data) {
            if ($id == 0) {
                $this->db->where($wherefieldname);
                return $this->db->update($tableName, $data);
            } else {
                if (is_array($wherefieldname)) {
                    foreach ($wherefieldname as $key => $value) {
                        $this->db->where($key, $value);
                    }
                    return $this->db->update($tableName, $data);
                } else {
                    $this->db->where($wherefieldname, $id);
                    return $this->db->update($tableName, $data);
                }
            }
        } else {
            return null;
        }
    }

    public function update_bulk($tableName, $wherefieldname, array $data = null)
    {
        if ($data) {
            $this->db->update_batch($tableName, $data, $wherefieldname);
        } else {
            return null;
        }
    }

    public function delete($tableName, $wherefieldname, $id)
    {
        $this->db->where($wherefieldname, $id);
        return $this->db->update($tableName, [$tableName . '.soft_delete' => 1]);
    }

    public function delete_bulk($tableName, string $wherefieldname = null, array $id = null)
    {
        if ($id) {
            $this->db->where_in($wherefieldname, $id);
            return $this->db->update($tableName, [$tableName . '.soft_delete' => 1]);
        } else {
            return null;
        }
    }

	public function delete_bulk_hard($tableName, string $wherefieldname = null, array $id = null)
	{
		if ($id) {
			$this->db->where_in($wherefieldname, $id);
			return $this->db->delete($tableName);
		} else {
			return null;
		}
	}

    public function restore($tableName, $id)
    {
        $this->db->where($tableName . '.id', $id);
        return $this->db->update($tableName, [$tableName . '.soft_delete' => 0]);
    }

    public function restore_bulk($tableName, array $id)
    {
        if ($id) {
            $this->db->where_in($tableName . '.id', $id);
            return $this->db->update($tableName, [$tableName . '.soft_delete' => 0]);
        } else {
            return null;
        }
    }

    public function deactivate($tableName, $wherefieldname, $id)
    {
        $this->db->where($wherefieldname, $id);
        return $this->db->update($tableName, [$tableName . '.is_active' => 0]);
    }

    public function null_column($col, $tableName, $wherefieldname, array $id = null, $where_in = true)
    {
        $this->db->set($col, null);
        if ($where_in === true)
            $this->db->where_in($wherefieldname, $id);
        else
            $this->db->where($wherefieldname, $id);
        return $this->db->update($tableName);
    }

	public function delete_hard($tableName, $wherefieldname, $id)
	{
		$this->db->where($wherefieldname, $id);
		return $this->db->delete($tableName);
	}
}
