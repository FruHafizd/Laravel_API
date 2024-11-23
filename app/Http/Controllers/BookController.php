<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class BookController extends Controller
{   
    const API_URL = "http://127.0.0.1:8000/api/book";

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $current_url = url()->current();
        $client = new Client();
        $url = static::API_URL;

        if ($request->input('page') != '') {
            $url .= "?page=". $request->input('page');
        }

        $response = $client->request('GET',$url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        $data = $contentArray['data'];
        foreach ($data['links'] as $key => $value) {
            $data['links'][$key]['url2'] = str_replace(static::API_URL, $current_url, $value['url']);
        }
        return view('book.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $title = $request->title;
        $author = $request->author;
        $publication_date = $request->publication_date;

        $parameter = [
            'title' => $title,
            'author' => $author,
            'publication_date' => $publication_date,
        ];

        $client = new Client();
        $url = "http://127.0.0.1:8000/api/book";
        $response = $client->request('POST',$url,[
            'headers' => ['Content-type' => 'application/json'],
            'body' => json_encode($parameter)
        ]);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        $data = $contentArray['status'];
        if ($contentArray['status'] != true) {
            $error = $contentArray['data'];
            return redirect()->to('book')->withErrors($error)->withInput();
        } else {
            return redirect()->to('book')->with('success','Successfuly added data');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/book/$id";
        $response = $client->request('GET',$url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);

        if ($contentArray['status'] != true) {
            $error = $contentArray['message'];
            return redirect()->to('book')->withErrors($error);
        }else {
            $data = $contentArray['data'];
            return view('book.index', compact('data'));
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $title = $request->title;
        $author = $request->author;
        $publication_date = $request->publication_date;

        $parameter = [
            'title' => $title,
            'author' => $author,
            'publication_date' => $publication_date,
        ];

        $client = new Client();
        $url = "http://127.0.0.1:8000/api/book/$id";
        $response = $client->request('PUT',$url,[
            'headers' => ['Content-type' => 'application/json'],
            'body' => json_encode($parameter)
        ]);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        $data = $contentArray['status'];
        if ($contentArray['status'] != true) {
            $error = $contentArray['data'];
            return redirect()->to('book')->withErrors($error)->withInput();
        } else {
            return redirect()->to('book')->with('success','Successfuly updated data');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/book/$id";
        $response = $client->request('DELETE',$url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content,true);
        $data = $contentArray['status'];
        if ($contentArray['status'] != true) {
            $error = $contentArray['data'];
            return redirect()->to('book')->withErrors($error)->withInput();
        } else {
            return redirect()->to('book')->with('success','Successfuly deleted data');
        }
    }
}
