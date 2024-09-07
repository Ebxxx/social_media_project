<?php
// // --------------------my code----------------

// class Profile_model extends User {
//     public function __construct() {
//         $this->load->database();
//     }

//     public function get_user($user_id) {
//         $query = $this->db->get_where('users', array('id' => $user_id));
//         return $query->row_array();
//     }

//     public function update_user($user_id, $data) {
//         $this->db->where('id', $user_id);
//         $this->db->update('users', $data);
//     }
// }

// namespace App\Models;

// use CodeIgniter\Model;

// class ProfileModel extends Model
// {
//     protected $table = 'profiles';
//     protected $primaryKey = 'id';
//     protected $allowedFields = ['user_id', 'name', 'email', 'profile_picture'];

//     public function getProfileByUserId($userId)
//     {
//         return $this->where('user_id', $userId)->first();
//     }

//     public function updateProfile($userId, $data)
//     {
//         return $this->where('user_id', $userId)->update($userId, $data);
//     }
// }
