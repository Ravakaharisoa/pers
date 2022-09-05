@extends('layouts.master_page')
@section('title')
@endsection
@section('content')
    <div class="shadow-lg p-3 mb-5 bg-body rounded container">
        <p class="white-50">
            Santé
        </p>
        <form action="" method="get" class="border border-2 rounded-2 border-black p-3">
            <div class="row">
                <div class="mb-3 col-6">
                    <label for="Allgerie" class="form-label">Allgerie</label>
                    <input type="text" name="allgerie" id="Allgerie" class="form-control" placeholder=""
                        aria-describedby="helpId">
                    {{-- <small id="helpId" class="text-muted">Help text</small> --}}
                </div>
                <div class="mb-3 col-6">
                    <label for="intollerence" class="form-label">Intollerance</label>
                    <input type="text" class="form-control" name="intollerence" id="intollerence"
                        aria-describedby="helpId" placeholder="">
                    {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
                </div>
                <div class="mb-3 col-6">
                    <label for="maladie_chronique" class="form-label">Maladie Chronique</label>
                    <input type="text" class="form-control" name="maladie_chronique" id="maladie_chronique"
                        aria-describedby="helpId" placeholder="">
                    {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
                </div>
                <div class="nav justify-content-end">
                    <button class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z" />
                            <path fill-rule="evenodd"
                                d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                        </svg>
                        Sauvegarder
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
