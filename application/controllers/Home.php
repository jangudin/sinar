<?php
class Home extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('M_home');
        $this->sina = $this->load->database('sina', TRUE);
        $this->dbfaskes = $this->load->database('dbfaskes', TRUE);
        if($this->session->userdata('status') != "login"){
            redirect(base_url());
        }
    }

    public function index()
    {
        $where = array('id' => $this->session->userdata('id'));
        $cek = 6;
        $query = "CALL SudahVerifikasiDirektur($cek)";
        $sql = $this->sina->query($query)->result();
        $data = array('contents' => 'listmutunonrssudahverif',
          'data'    => $sql,
          // 'data_all'    => $this->M_home->get_data(),
      );

      //  print_r($sql);
      //  $this->load->view('templates',$data);
        echo json_encode($data);
    }
    public function C_data()
    {
        echo "hallo";
    }
}