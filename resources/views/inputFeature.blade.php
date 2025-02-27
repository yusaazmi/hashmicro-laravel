@extends('layouts.app')
@section('content')

    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
            <h2 class="mb-4">Form Input</h2>
            <form id="checkForm">
                @csrf
                <div class="mb-3">
                    <label for="keyword" class="form-label">Keyword</label>
                    <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Masukkan teks pertama">
                </div>
                <div class="mb-3">
                    <label for="word" class="form-label">Word</label>
                    <input type="text" class="form-control" id="word" name="word" placeholder="Masukkan teks kedua">
                </div>
    
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div id="hasil" class="mt-4"></div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
      $(document).ready(function () {
          $("#checkForm").submit(function (event) {
              event.preventDefault();
              var keyword = $("#keyword").val();
              var word = $("#word").val();
              
              $.ajax({
                  url: "{{ route('store-input-feature') }}",
                  method: "POST",
                  data: {
                      _token: "{{ csrf_token() }}",
                      keyword: keyword,
                      word: word
                  },
                  success: function (response) {
                      $("#hasil").html('<div class="alert alert-success">' + response.percentage + '% karakter ditemukan.</div>');
                  },
                  error: function () {
                      $("#hasil").html('<div class="alert alert-danger">Terjadi kesalahan.</div>');
                  }
              });
          });
      });
  </script>
@endsection