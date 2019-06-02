<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Production_C extends CI_Controller {
    public function __construct(){
        parent::__construct();
         // $this->load->library('Pdf');
          $this->load->model('Production_m');
          $this->load->model('Operation_m');
          $this->load->model('Poste_m');

    }

    public function index()
    {  
        
        $getProduction = $this->Production_m->getProduction();
        $this->load->view('layouts/Admin_header');
        $this->load->view('admin/Production_V',['Production'=>$getProduction]);
        $this->load->view('layouts/Admin_footer');
    }


    public function afficher(){
        $getPoste = $this->Production_m->getPoste();
        $this->load->view('layouts/Admin_header');
        $this->load->view('admin/Prod_employe_V',['Poste'=>$getPoste]);
        $this->load->view('layouts/Admin_footer');
    }

    public function afficher_date(){
        $this->load->view('layouts/Admin_header');
        $this->load->view('admin/ProdDate_V');
        $this->load->view('layouts/Admin_footer');
    }
    public function afficher_emp(){
        $result = array('data'=> array());
        $data = $this->Production_m->afficher_emp();
        foreach ($data as $key => $value){
             $result['data'][$key] = array(
                $value['op_version'],
                $value['op_date_execution'],
                $value['op_date_transfert'],
                $value['op_nb_defaut']
            );
        }
        echo json_encode($result);
    }
    public function afficheEmp(){
        $numero_emp = $this->input->post('numero_emp');
        $data = $this->Production_m->getEmploye_id($numero_emp);
        return $this->output->set_output(json_encode($data));
    }
    public function affiche(){
        $dateDebut = $this->input->post('dateDebut');
        $dateFin = $this->input->post('dateFin');

        $affiche = $this->Operation_m->affiche($dateDebut,$dateFin);
        $tmp = array();
        for ($i=0;$i < count($affiche);$i++){
        $volTransf = intval($affiche[$i]->volume)-intval($affiche[$i]->op_nb_defaut);
        $result["version"]=$affiche[$i]->version;
        $result["op_nb_defaut"]=$affiche[$i]->op_nb_defaut;
        $result["volTransf"]=$volTransf;
        $tmp[] = $result;     
        }
        return $this->output->set_output(json_encode($tmp));

    }
}    