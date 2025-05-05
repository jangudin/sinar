public function Detail()
                        {
                            
                            $uri = $this->uri->segment(3);
                            $id = decrypt_url($uri);
                            $nonik = $this->session->userdata('nik'); 
                            $data = array('contents' => "lembaga/Contentdetail",
                                          'rs'    => $this->Dashboard_tte->Detail($id),
                                          'lembaga' => $this->session->userdata('lembaga_id'),
                                          'attachment' => is_file(FCPATH . $attachment) ? base_url($attachment) : null,
                                          'nik' => $nonik,
                                          'id' => $id,
                                         );

         $this->load->view('List_Rekomendasi',$data);
            }