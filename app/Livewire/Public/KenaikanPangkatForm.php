<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Service;
use App\Models\Submission;
use App\Models\TrackingLog;

class KenaikanPangkatForm extends Component
{
    use WithFileUploads;

    public $jenis_kenaikan_pangkat = 'fungsional'; // fungsional, reguler, struktural, penyesuaian_ijazah

    // Identity
    public $nama;
    public $nip;
    public $no_hp;
    public $unit_kerja;
    public $jabatan;
    public $golongan;

    // Common Files
    public $sk_cpns;
    public $sk_pns;
    public $skp_1; // Pertama
    public $skp_2; // Kedua
    public $sk_kp_terakhir;
    public $sk_jabatan_terakhir;
    public $sk_jabatan_atasan; // PLT/PLH/Mutasi for some, general for others
    public $ijazah;
    public $transkrip;

    // Fungsional Specific
    public $serdik; // Guru
    public $sk_penugasan; // Mutasi
    public $pak; // Konvensional/Integrasi/Konversi
    public $sk_pengangkatan_pertama_jf;
    public $sk_jf_terakhir;
    public $sk_kenaikan_jenjang;
    public $uji_kompetensi;
    public $doc_pendidikan_baru; // Ijazah/Transkrip/Izin Belajar (Penambahan Gelar)
    public $surat_pencantuman_gelar; 

    // Reguler Specific
    public $ujian_dinas; // IId -> IIIa
    public $doc_peningkatan_pendidikan; // Ijazah/Transkrip/Surat Pencantuman Gelar

    // Struktural Specific
    public $surat_pelantikan;

    // Penyesuaian Ijazah Specific
    public $stl_upkp;
    public $uraian_tugas;

    public $tracking_code;

    protected function rules()
    {
        $rules = [
            'jenis_kenaikan_pangkat' => 'required|in:fungsional,reguler,struktural,penyesuaian_ijazah',
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:20',
            'no_hp' => 'required|string|max:15',
            'unit_kerja' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'golongan' => 'required|string|max:100',
            
            // Common
            'sk_cpns' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'sk_pns' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'skp_1' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'skp_2' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'sk_kp_terakhir' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'ijazah' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'transkrip' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ];

        // Conditional Rules Based on Type
        if ($this->jenis_kenaikan_pangkat === 'fungsional') {
            $rules['pak'] = 'required|file|mimes:pdf|max:2048';
            $rules['sk_pengangkatan_pertama_jf'] = 'required|file|mimes:pdf|max:2048';
            $rules['sk_jf_terakhir'] = 'required|file|mimes:pdf|max:2048';
            $rules['sk_jabatan_atasan'] = 'nullable|file|mimes:pdf|max:2048'; // PLT/PLH/Mutasi
        }

        if ($this->jenis_kenaikan_pangkat === 'reguler') {
            $rules['sk_jabatan_terakhir'] = 'required|file|mimes:pdf|max:2048';
            $rules['sk_jabatan_atasan'] = 'nullable|file|mimes:pdf|max:2048';
            $rules['ujian_dinas'] = 'nullable|file|mimes:pdf|max:2048';
        }

        if ($this->jenis_kenaikan_pangkat === 'struktural') {
            $rules['sk_jabatan_terakhir'] = 'required|file|mimes:pdf|max:2048';
            $rules['surat_pelantikan'] = 'required|file|mimes:pdf|max:2048';
            $rules['sk_jabatan_atasan'] = 'nullable|file|mimes:pdf|max:2048';
            $rules['ujian_dinas'] = 'nullable|file|mimes:pdf|max:2048';
        }

        if ($this->jenis_kenaikan_pangkat === 'penyesuaian_ijazah') {
            $rules['sk_jabatan_terakhir'] = 'required|file|mimes:pdf|max:2048';
            $rules['stl_upkp'] = 'required|file|mimes:pdf|max:2048';
            $rules['uraian_tugas'] = 'required|file|mimes:pdf|max:2048';
        }

        return $rules;
    }

    public function save()
    {
        $this->validate();

        $service = Service::where('slug', 'kenaikan-pangkat')->firstOrFail();

        // Store Files Logic
        $files = [];
        $common_fields = ['sk_cpns', 'sk_pns', 'skp_1', 'skp_2', 'sk_kp_terakhir', 'ijazah', 'transkrip'];
        foreach ($common_fields as $field) {
            $files[$field] = $this->$field->store('attachments/kp', 'public');
        }

        // Conditional Storage
        $conditional_fields = [
            'sk_jabatan_terakhir', 'sk_jabatan_atasan', // Shared
            'serdik', 'sk_penugasan', 'pak', 'sk_pengangkatan_pertama_jf', 'sk_jf_terakhir', 'sk_kenaikan_jenjang', 'uji_kompetensi', 'doc_pendidikan_baru', 'surat_pencantuman_gelar', // Fungsional
            'ujian_dinas', 'doc_peningkatan_pendidikan', // Reguler
            'surat_pelantikan', // Struktural
            'stl_upkp', 'uraian_tugas' // PI
        ];

        foreach ($conditional_fields as $field) {
            if ($this->$field) {
                $files[$field] = $this->$field->store('attachments/kp', 'public');
            }
        }

        $code = 'KP-' . now()->format('dmY') . '-' . strtoupper(Str::random(5));

        $submission = Submission::create([
            'service_id' => $service->id,
            'tracking_code' => $code,
            'status' => 'pending',
            'content' => [
                'jenis_kenaikan_pangkat' => $this->jenis_kenaikan_pangkat,
                'nama' => $this->nama,
                'nip' => $this->nip,
                'no_hp' => $this->no_hp,
                'unit_kerja' => $this->unit_kerja,
                'jabatan' => $this->jabatan,
                'golongan' => $this->golongan,
                'files' => $files,
            ],
        ]);

        TrackingLog::create([
            'submission_id' => $submission->id,
            'status' => 'pending',
            'note' => 'Permohonan Kenaikan Pangkat (' . ucfirst(str_replace('_', ' ', $this->jenis_kenaikan_pangkat)) . ') baru diajukan.',
        ]);

        $this->tracking_code = $code;
        $this->reset(['nama', 'nip', 'no_hp', 'unit_kerja', 'jabatan', 'golongan', 'sk_cpns', 'sk_pns', 'skp_1', 'skp_2', 'sk_kp_terakhir', 'ijazah', 'transkrip', 'sk_jabatan_terakhir', 'sk_jabatan_atasan', 'pak']); 
        // Resetting all is cleaner but listing explicit fields is safer. For brevity resetting core ones.

        session()->flash('message', 'Permohonan berhasil dikirim! Kode Tracking Anda: ' . $code);
    }

    public function render()
    {
        return view('livewire.public.kenaikan-pangkat-form');
    }
}
