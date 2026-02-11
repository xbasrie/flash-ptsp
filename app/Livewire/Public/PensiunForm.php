<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Service;
use App\Models\Submission;
use App\Models\TrackingLog;

class PensiunForm extends Component
{
    use WithFileUploads;
    use \App\Traits\ChecksServiceStatus;

    public function boot()
    {
        $this->checkServiceAvailability('pensiun');
    }

    public $jenis_pensiun = 'bup'; // bup, janda_duda, uzur, aps

    // Identity
    public $nama;
    public $email;
    public $nip;
    public $no_hp;
    public $unit_kerja;
    public $jabatan;
    public $golongan;
    public $tmt_pensiun; // For BUP & Janda/Duda

    // Files (Massive List - keeping them specific or generic?)
    // Using specific names for clarity as per requirement
    public $sk_cpns;
    public $sk_pns;
    public $sk_kp_terakhir;
    public $skp_1_tahun;
    public $kk;
    public $daftar_susunan_keluarga; // merged often, but listed separately
    public $sk_kgb;
    public $ijazah_sd;
    public $transkrip_sd;
    public $ijazah_smp;
    public $transkrip_smp;
    public $ijazah_sma;
    public $transkrip_sma;
    public $ijazah_s1;
    public $transkrip_s1;
    public $ijazah_s2;
    public $transkrip_s2;
    public $ijazah_s3;
    public $transkrip_s3;
    public $buku_rekening;
    public $npwp;
    public $ktp_suami_istri;
    public $pas_foto; // Suami/Istri/Anak
    public $sk_jabatan_mutasi; // SK Jabatan/Mutasi
    
    // Conditional / Specific
    public $surat_permohonan; // BUP
    public $akta_nikah; // BUP, Janda/Duda, Uzur, APS
    public $akta_kelahiran_anak; // BUP, Janda/Duda, Uzur, APS
    public $akta_kelahiran_suami_istri; // BUP, Janda/Duda
    public $sk_pmk; // BUP, Janda/Duda, Uzur, APS
    public $surat_pengantar; // Janda/Duda, Uzur, APS
    public $akta_cerai_kematian; // Janda/Duda, Uzur, APS
    public $surat_keterangan_kematian; // Janda/Duda
    public $dpcp; // Uzur, APS
    public $surat_keterangan_dokter; // Uzur
    public $surat_permohonan_aps; // APS
    public $surat_persetujuan_aps; // APS

    public $tracking_code;

    protected function rules()
    {
        $rules = [
            'jenis_pensiun' => 'required|in:bup,janda_duda,uzur,aps',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nip' => 'required|string|max:20',
            'no_hp' => 'required|string|max:15',
            'unit_kerja' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'golongan' => 'required|string|max:100',
            
            // Common to most
            'sk_cpns' => 'required|file|mimes:pdf|max:2048',
            'sk_pns' => 'required|file|mimes:pdf|max:2048',
            'sk_kp_terakhir' => 'required|file|mimes:pdf|max:2048',
            'skp_1_tahun' => 'required|file|mimes:pdf|max:2048',
            'kk' => 'required|file|mimes:pdf|max:2048',
            'sk_kgb' => 'required|file|mimes:pdf|max:2048',
            'ijazah_sd' => 'required|file|mimes:pdf|max:2048',
            'transkrip_sd' => 'required|file|mimes:pdf|max:2048',
            'ijazah_smp' => 'required|file|mimes:pdf|max:2048',
            'transkrip_smp' => 'required|file|mimes:pdf|max:2048',
            'ijazah_sma' => 'required|file|mimes:pdf|max:2048',
            'transkrip_sma' => 'required|file|mimes:pdf|max:2048',
            // S1-S3 optional usually, making nullable
            'ijazah_s1' => 'nullable|file|mimes:pdf|max:2048',
            'transkrip_s1' => 'nullable|file|mimes:pdf|max:2048',
            'ijazah_s2' => 'nullable|file|mimes:pdf|max:2048',
            'transkrip_s2' => 'nullable|file|mimes:pdf|max:2048',
            'ijazah_s3' => 'nullable|file|mimes:pdf|max:2048',
            'transkrip_s3' => 'nullable|file|mimes:pdf|max:2048',

            // Optional/Common
            'akta_nikah' => 'nullable|file|mimes:pdf|max:2048',
            'akta_kelahiran_anak' => 'nullable|file|mimes:pdf|max:2048',
            'sk_pmk' => 'nullable|file|mimes:pdf|max:2048',
        ];

        if ($this->jenis_pensiun === 'bup') {
            $rules['tmt_pensiun'] = 'required|date';
            $rules['surat_permohonan'] = 'required|file|mimes:pdf|max:2048';
            $rules['akta_kelahiran_suami_istri'] = 'required|file|mimes:pdf|max:2048';
            $rules['buku_rekening'] = 'required|file|mimes:pdf|max:2048';
            $rules['npwp'] = 'required|file|mimes:pdf|max:2048';
            $rules['ktp_suami_istri'] = 'required|file|mimes:pdf|max:2048';
            $rules['pas_foto'] = 'required|image|max:2048';
            $rules['sk_jabatan_mutasi'] = 'required|file|mimes:pdf|max:2048';
        }

        if ($this->jenis_pensiun === 'janda_duda') {
            $rules['tmt_pensiun'] = 'required|date';
            $rules['surat_pengantar'] = 'required|file|mimes:pdf|max:2048';
             // Akta Nikah/Cerai/Kematian handled by akta_nikah or separate field? prompt says "Akta Nikah/Cerai/Kematian"
            $rules['akta_cerai_kematian'] = 'nullable|file|mimes:pdf|max:2048'; 
            $rules['akta_kelahiran_suami_istri'] = 'required|file|mimes:pdf|max:2048';
            $rules['surat_keterangan_kematian'] = 'required|file|mimes:pdf|max:2048';
             $rules['buku_rekening'] = 'required|file|mimes:pdf|max:2048';
            $rules['npwp'] = 'required|file|mimes:pdf|max:2048';
            $rules['ktp_suami_istri'] = 'required|file|mimes:pdf|max:2048';
            $rules['pas_foto'] = 'required|image|max:2048';
            $rules['sk_jabatan_mutasi'] = 'required|file|mimes:pdf|max:2048';
        }

        if ($this->jenis_pensiun === 'uzur') {
            $rules['surat_pengantar'] = 'required|file|mimes:pdf|max:2048';
            $rules['dpcp'] = 'required|file|mimes:pdf|max:2048';
            $rules['surat_keterangan_dokter'] = 'required|file|mimes:pdf|max:2048';
             $rules['akta_cerai_kematian'] = 'nullable|file|mimes:pdf|max:2048'; // Akta Nikah/Cerai/Kematian Pasangan
        }

        if ($this->jenis_pensiun === 'aps') {
            $rules['surat_pengantar'] = 'required|file|mimes:pdf|max:2048';
            $rules['dpcp'] = 'required|file|mimes:pdf|max:2048';
            $rules['surat_permohonan_aps'] = 'required|file|mimes:pdf|max:2048';
            $rules['surat_persetujuan_aps'] = 'required|file|mimes:pdf|max:2048';
            $rules['akta_cerai_kematian'] = 'nullable|file|mimes:pdf|max:2048';
        }

        return $rules;
    }

    public function save()
    {
        $this->validate();

        $service = Service::where('slug', 'pensiun')->firstOrFail();

        $files = [];
        // Map all potential file fields
        $potential_files = [
            'sk_cpns', 'sk_pns', 'sk_kp_terakhir', 'skp_1_tahun', 'kk', 'sk_kgb', 
            'ijazah_sd', 'transkrip_sd', 'ijazah_smp', 'transkrip_smp', 'ijazah_sma', 'transkrip_sma',
            'ijazah_s1', 'transkrip_s1', 'ijazah_s2', 'transkrip_s2', 'ijazah_s3', 'transkrip_s3',
            'akta_nikah', 'akta_kelahiran_anak', 'sk_pmk',
            'surat_permohonan', 'akta_kelahiran_suami_istri', 'buku_rekening', 'npwp', 'ktp_suami_istri', 'pas_foto', 'sk_jabatan_mutasi',
            'surat_pengantar', 'akta_cerai_kematian', 'surat_keterangan_kematian',
            'dpcp', 'surat_keterangan_dokter',
            'surat_permohonan_aps', 'surat_persetujuan_aps'
        ];

        foreach ($potential_files as $field) {
            if ($this->$field) {
                $files[$field] = $this->$field->store('attachments/pensiun', 'public');
            }
        }

        $code = 'P-' . now()->format('dmY') . '-' . strtoupper(Str::random(5));

        $submission = Submission::create([
            'service_id' => $service->id,
            'tracking_code' => $code,
            'status' => 'pending',
            'content' => [
                'jenis_pensiun' => $this->jenis_pensiun,
                'nama' => $this->nama,
                'email' => $this->email,
                'nip' => $this->nip,
                'no_hp' => $this->no_hp,
                'unit_kerja' => $this->unit_kerja,
                'jabatan' => $this->jabatan,
                'golongan' => $this->golongan,
                'tmt_pensiun' => $this->tmt_pensiun,
                'files' => $files,
            ],
        ]);

        TrackingLog::create([
            'submission_id' => $submission->id,
            'status' => 'pending',
            'note' => 'Permohonan Pensiun (' . strtoupper($this->jenis_pensiun) . ') baru diajukan.',
        ]);

        $this->reset();
        $this->tracking_code = $code;

        $this->dispatch('show-success-modal', message: 'Permohonan berhasil dikirim! Kode Tracking Anda: ' . $code);
    }

    public function render()
    {
        return view('livewire.public.pensiun-form');
    }
}
