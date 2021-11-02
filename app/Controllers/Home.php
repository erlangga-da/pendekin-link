<?php

namespace App\Controllers;

use App\Models\UrlModel;

class Home extends BaseController
{
    protected $UrlModel;

    public function __construct()
    {
        $this->UrlModel = new UrlModel();
    }

    public function index()
    {
        $this->active['home'] = 'active';
        $data = [
            'title' => "Home | Link Shortener",
            'active' => $this->active
        ];
        return view('home', $data);
    }

    public function about()
    {
        $this->active['about'] = 'active';
        $data = [
            'title' => "About | Link Shortener",
            'active' => $this->active
        ];
        return view('about', $data);
    }

    public function getLink($url_short)
    {
        $url_short = 'localhost:8080/' . $url_short;
        $url = $this->UrlModel->where('short_url', $url_short)->first();

        if ($url) {
            if (!headers_sent($file, $line))
            {
            header("Location: ". $url['long_url']);
            exit;
            }
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('URL : ' . $url_short . ' tidak ditemukan');
        }
    }

    public function save()
    {
        if (isset($_POST)) {
            $this->send['url_awal'] = implode($_POST);
        }

        if ($this->send['url_awal']) {
            $shuffle_res = [
                'alpha' => 'QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm',
                'alphanum' => '0123456789QWERTYUIPASDFGHJKLZXCVBNMqwertyuipasdfghjklzxcvbnm',
            ];
            $alpha = substr(str_shuffle($shuffle_res['alpha']), 0, 2);
            $alphanum = substr(str_shuffle($shuffle_res['alphanum']), 0, 4);
            $this->send['url_short'] = 'localhost:8080/' . $alpha . $alphanum;
        }

        session()->setFlashdata('msg', 'Your New Link : ' .  $this->send['url_short']);

        $this->UrlModel->save(
            [
                'long_url' => $this->send['url_awal'],
                'short_url' => $this->send['url_short'],
            ]
        );

        return view('save');
    }
}
