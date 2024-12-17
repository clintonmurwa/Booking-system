<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slots_model extends CI_Model {

    public function getAllSlots() {
        return $this->db->get('slots')->result_array();
    }
    public function update_slot_availability($slot_id, $availability) {
		$data = [
			'available' => $availability
		];
	
		// Update the slot record in the database
		$this->db->where('id', $slot_id);
		$this->db->update('slots', $data);
	}

       // Get all available slots
       public function get_all_available_slots() {
        $this->db->select('*');
        $this->db->from('slots');
        $this->db->where('available', 1); // Assuming 'available' marks the slot as free
        $this->db->where('id NOT IN (SELECT slot_id FROM bookings)', NULL, FALSE); // Exclude booked slots
        $query = $this->db->get();
        return $query->result_array();
    }

     // Get slot by ID
     public function get_slot_by_id($slot_id) {
        $query = $this->db->get_where('slots', ['id' => $slot_id]);
        return $query->row_array();
    }

    public function getSlotById($id) {
        return $this->db->where('id', $id)->get('slots')->row_array();
    }

    public function addSlot($data) {
        return $this->db->insert('slots', $data);
    }

    public function updateSlot($id, $data) {
        return $this->db->where('id', $id)->update('slots', $data);
    }

    public function deleteSlot($id) {
        return $this->db->where('id', $id)->delete('slots');
    }
}
