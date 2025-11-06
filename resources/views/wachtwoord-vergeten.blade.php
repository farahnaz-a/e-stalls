@extends('layouts.main')

@section('title', 'Account aanmaken')

@section('content')
  <div class="normal-section gradient wf-section">
    <div class="container center w-container">
      <div class="login-form">
        <form action="" method="post" class="create-account">
          @csrf
          <h1 class="dark">Wachtwoord vergeten? </h1>
            <input type="email" class="text-field w-input" maxlength="256" name="email" required placeholder="Email" id="name">
            <input type="submit" value="Aanvragen" data-wait="Please wait..." class="button w-button">
              <p style="margin-top: 40px;">Voer het e-mailadres in dat je hebt gebruikt om jouw E-stalls-account aan te maken. Wij sturen je dan een link waarmee je een nieuw wachtwoord kunt aanmaken. Let op! Indien het door jou ingevulde e-mailadres niet bij ons bekend is, ontvang je geen e-mail.</p>
              @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
              @endif
        </form>
      </div>
    </div>
  </div>
@endsection


@push('js')
    @if(session('msg'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function () {
            Swal.fire({
                icon: "info",
                title: "{{ session('msg') }}",
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>
    @endif
@endpush
