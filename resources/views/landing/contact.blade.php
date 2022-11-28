@extends('layouts.landing.main')

@section('title',"Kontakt os")
@section('content')
<div class="container p-4 my-5">
    <div class="row justify-content-between">
        <div class="col-lg-6 pr-lg-5">
            <h2 class="mb-4" style="color:#003F87;"><strong>Spørgsmål inden du starter?</strong></h2>
            <p>
            Vi er klar til at hjælpe dig med alle de spørgsmål du måtte have. Vi har skrevet en FAQ, som måske kan hjælpe dig i gang.
            </p>
            <p>
            Skriv til os. Vi sidder klar.
            </p>
            <hr>
            <p class="py-4">Mercury Ads FZE<br>PO BOX 7073<br>Umm Al Quwain<br>United Arab Emirates<br></p>
        </div>
        <div class="col-lg-5">
            <form action="{{ route('kontakt'); }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="company">Company <span class="text-danger">*</span></label>
                    <input type="text" name="company" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone <span class="text-danger">*</span></label>
                    <input type="number" name="phone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input type="mail" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Message</label>
                    <textarea name="message" cols="20" rows="10" class="form-control"></textarea>
                </div>
                <input type="submit" name="submit" value="Send Request" class="btn btn-block" style="background-color:#003F87;color:#ffff;">
            </form>
        </div>
    </div>
</div>

<!-- /.login-box -->
</div>
@endsection