<?php

class imagemodel extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    
    /*
     * carga la imagenes de los items de encuesta
     */
    public function putGalleryItem($items_id,$uri_img,$image) {
        $data = array(
            'id_items_event' => $this->db->escape_str($items_id),
            'uri_img' => $this->db->escape_str($uri_img),
            'image' => $this->db->escape_str($image),
            'status_img' => $this->db->escape_str('1'),
            'status_galery' => $this->db->escape_str('0'),
            'date_create' => date('Y-m-d h:m:s'),
            'user' => $this->db->escape_str($this->session->userdata['user'])    
        );

        $this->db->insert('item_poll_img', $data);
    }
    
    /*
     * desactiva la imagenes no deseadas
     */
    public function inactiveImage($items_id,$image) {
        $data = array(
            'status_img' => $this->db->escape_str('0')  
        );
        $this->db->where('image',$image);
        $this->db->where('id_items_event',$items_id);
        $this->db->update('item_poll_img', $data);
    }
    
    /*
     * desactiva la imagenes no deseadas
     */
    public function activateGallery($items_id) {
        $data = array(
            'status_galery' => $this->db->escape_str('1')  
        );
        $this->db->where('id_items_event',$items_id);
        $this->db->update('item_poll_img', $data);
    }
}

