<?php
/**
 * RumahSakitController.php
 *
 * @package App\Http\Controllers
 * @author  Ferdhika Yudira
 * @email   fer@dika.web.id
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RumahSakit;

class RumahSakitController extends Controller
{
    public function index(Request $request){

        $data = RumahSakit::with(['kelurahan' => function($q){
            $q->select('kode_kelurahan', 'nama_kelurahan');
        }])->get();

        return $this->returnData($data, "Data retrieved.");
    }
}
