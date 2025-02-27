<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\TramitesModel;
use App\Models\AfiliadosModel;
use App\Models\DelegacionesModel;
use App\Models\TiposTramiteModel;

class Tramites extends ResourceController
{
    protected $modelName  = TramitesModel::class; 
    protected $format     = 'json';              
    
    // 1. Listar todos los trámites
    public function index()
    {
        // Cargamos datos  con join  otras tablas
        $tramites = $this->model
            ->select("
                tramites.*,
                CONCAT(af.nombre, ' ', af.apellido) AS afiliado_nombre,
                del.nombre AS delegacion_inicia,
                tt.descripcion AS tipo_tramite
            ")
            ->join('afiliados af', 'af.id = tramites.afiliado_id')
            ->join('delegaciones del', 'del.id = tramites.delegacion_inicia_id')
            ->join('tipos_tramite tt', 'tt.id = tramites.tramite_id')
            ->orderBy('tramites.id', 'DESC')
            ->findAll();

        // Si nuestra vista es HTML (no JSON), devolvemos la vista
        $afiliadosModel       = new AfiliadosModel();
        $delegacionesModel    = new DelegacionesModel();
        $tiposTramiteModel    = new TiposTramiteModel();

        $data['tramites']     = $tramites;
        $data['afiliados']    = $afiliadosModel->findAll();
        $data['delegaciones'] = $delegacionesModel->findAll();
        $data['tipos']        = $tiposTramiteModel->findAll();
        
        return view('tramites/index', $data);
    }

    // 2. Form para crear un nuevo Trámite
    // GET /tramites/new
    public function new()
    {
        $afiliadosModel       = new AfiliadosModel();
        $delegacionesModel    = new DelegacionesModel();
        $tiposTramiteModel    = new TiposTramiteModel();

        $data['afiliados']    = $afiliadosModel->findAll();
        $data['delegaciones'] = $delegacionesModel->findAll();
        $data['tipos']        = $tiposTramiteModel->findAll();

        return view('tramites/new', $data);
    }

    // 3. Guardar el nuevo Trámite
    // POST /tramites
    public function create()
    {
        // Validaciones mínimas
        $valid = $this->validate([
            'afiliado_id'          => 'required|numeric',
            'tramite_id'           => 'required|numeric',
            'delegacion_inicia_id' => 'required|numeric',
            'fecha_inicio'         => 'required',
            'expediente'           => 'is_unique[tramites.expediente]',
        ]);

        if (! $valid) {
            return redirect()->back()
                             ->withInput()
                             ->with('errors', $this->validator->getErrors());
        }

        $postData = [
            'afiliado_id'          => $this->request->getPost('afiliado_id'),
            'tramite_id'           => $this->request->getPost('tramite_id'),
            'delegacion_inicia_id' => $this->request->getPost('delegacion_inicia_id'),
            'fecha_inicio'         => $this->request->getPost('fecha_inicio'),
            'observaciones'        => $this->request->getPost('observaciones'),
            'expediente'           => $this->request->getPost('expediente'),
            'usuario_carga'        => 'admin'
        ];

        $this->model->insert($postData);

        return redirect()->to('/tramites')
                         ->with('message', 'Trámite creado con éxito.');
    }

    // 4. Form para editar un trámite
    // GET /tramites/(:num)/edit
    public function edit($id = null)
    {
        if (! $id) {
            return redirect()->to('/tramites');
        }

        $tramite = $this->model->find($id);
        if (! $tramite) {
            return redirect()->to('/tramites')->with('error', 'Trámite no encontrado');
        }

        $afiliadosModel       = new AfiliadosModel();
        $delegacionesModel    = new DelegacionesModel();
        $tiposTramiteModel    = new TiposTramiteModel();

        $data['tramite']      = $tramite;
        $data['afiliados']    = $afiliadosModel->findAll();
        $data['delegaciones'] = $delegacionesModel->findAll();
        $data['tipos']        = $tiposTramiteModel->findAll();

        return view('tramites/edit', $data);
    }

    // 5. Actualizar trámite
    // PUT /tramites/(:num)
    public function update($id = null)
    {
        if (! $id) {
            return redirect()->to('/tramites');
        }

        $tramite = $this->model->find($id);
        if (! $tramite) {
            return redirect()->to('/tramites')->with('error', 'No existe el trámite');
        }

        $valid = $this->validate([
            'afiliado_id'          => 'required|numeric',
            'tramite_id'           => 'required|numeric',
            'delegacion_inicia_id' => 'required|numeric',
            'fecha_inicio'         => 'required',
            'expediente' => [
                'rules'  => "required|is_unique[tramites.expediente,id,{$id}]",
                'errors' => [
                    'is_unique' => 'El expediente ya existe.'
                ]
            ]
        ]);

        if (!$valid) {
            return redirect()->back()
                             ->withInput()
                             ->with('errors', $this->validator->getErrors());
        }

        $postData = [
            'afiliado_id'          => $this->request->getPost('afiliado_id'),
            'tramite_id'           => $this->request->getPost('tramite_id'),
            'delegacion_inicia_id' => $this->request->getPost('delegacion_inicia_id'),
            'fecha_inicio'         => $this->request->getPost('fecha_inicio'),
            'observaciones'        => $this->request->getPost('observaciones'),
            'expediente'           => $this->request->getPost('expediente')
            // usuario_carga lo dejamos como está
        ];

        $this->model->update($id, $postData);

        return redirect()->to('/tramites')->with('message', 'Trámite actualizado con éxito.');
    }

    // 6. Eliminar trámite
    // DELETE /tramites/(:num)
    public function delete($id = null)
    {
        if (! $id) {
            return redirect()->to('/tramites');
        }

        $tramite = $this->model->find($id);
        if (! $tramite) {
            return redirect()->to('/tramites')->with('error', 'No existe el trámite a eliminar');
        }

        $this->model->delete($id);

        return redirect()->to('/tramites')->with('message', 'Trámite eliminado correctamente.');
    }
}
