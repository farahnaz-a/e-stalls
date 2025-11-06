@extends('layouts.vendor')
@section('wfdata', '6221e4bcc0ed2f0edb5997e8')
@section('title', 'Vendor Paneel - E-STALLS')
@section('content')
<div class="normal-section gradient wf-section">
  <div class="container center w-container">
      <div class="login-form" style="width: 460px;">
        <form method="POST" action="{{url('vendor/products/add')}}" enctype="multipart/form-data" class="create-account">
            @csrf
            <h1 class="dark">Product toevoegen</h1>
            <input type="text" class="text-field nomaxw w-input" maxlength="256" name="name" placeholder="Naam" required="">
            <input type="number" class="text-field nomaxw w-input" step="0.01" name="price" placeholder="Prijs €" required="">
            <textarea maxlength="5000" name="desc" required="" class="w-input" required placeholder="Beschrijving"></textarea>
            <label>Productafbeelding</label>
            <input type="file" class="text-field nomaxw w-input" name="image_url[]" required="" multiple accept="image/*">
            <input type="number" class="text-field nomaxw w-input" name="stock" id="stock" placeholder="Voorraad" required="">
            <label>BTW</label>
            <select name="tax" class="text-field nomaxw w-input" id="">
                <option value="21">21%</option>
                <option value="9">9%</option>
            </select>
            <label style="display: inline-flex; align-items: center; cursor: pointer; font-size: 16px; margin-bottom: 24px">
                <input type="checkbox" name="size_status" style="width: 20px; height: 20px; margin-right: 10px; cursor: pointer;" id="haveSize"> Heeft dit product een maatoptie?
            </label>  
            <div id="sizeWrap" style="display: none">
                <div style="display: flex">
                    <input type="text" style="margin-right: 5px" class="text-field nomaxw w-input size_name" maxlength="256" name="size_name[]" placeholder="Maat">
                    <input type="number" class="text-field nomaxw w-input size_stock" maxlength="256" name="size_stock[]" placeholder="Voorraad">
                    <div>
                        <button type="button" id="addNewSizeItem" style="font-size: 20px; padding: 5px 10px; background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer;">+</button>
                    </div>
                </div>
            </div>
            <span id="errorMessage" style="display: none; padding: 10px 15px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 4px; font-family: Arial; font-size: 14px;">
            ⚠️ Let op!: De voorraad moet overeenkomen met de totale omvang van de voorraad!
            </span>
            <br>

            <input type="submit" value="Toevoegen" data-wait="Please wait..." class="button w-button">

        <div style="color: red; margin-top: 10px">
            <ul>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                @endif
            </ul>
        </div>
        </form>
      </div>
  </div>
</div>
@endsection
@push('js')
    <script>
        $(document).ready(function(){
            $("body").on('click', '#haveSize', function(){
                if($(this).is(':checked')){
                    $('#sizeWrap').slideDown();
                    $('.size_name').attr('required', true);
                    $('.size_stock').attr('required', true);
                }else{
                    $('#sizeWrap').slideUp();
                    $('.size_name').attr('required', false);
                    $('.size_stock').attr('required', false);
                }
            });

            $("#addNewSizeItem").on('click', function(){
                $("#sizeWrap").append(`
                    <div class="size-item" style="display:none">
                        <div style="display: flex">
                            <input type="text" style="margin-right: 5px" class="text-field nomaxw w-input size_name" maxlength="256" name="size_name[]" placeholder="Maat" required>
                            <input type="number" class="text-field nomaxw w-input size_stock" maxlength="256" name="size_stock[]" placeholder="Voorraad" required>
                            <div>
                                <button type="button" class="removeSizeItem" style="font-size: 20px; padding: 5px 11px; background-color: #ea3e3e; color: white; border: none; border-radius: 5px; cursor: pointer;">x</button>
                            </div>
                        </div>
                    </div>
                `);
                $(".size-item").slideDown();
                $('#errorMessage').css('display', 'none');
            });
            $("body").on('click', '.removeSizeItem', function(){
                $('#errorMessage').css('display', 'none');
                $(this).closest('.size-item').slideUp(function(){
                    $(this).remove();
                })
            });

            let verified = false;
            $("body").on('submit', '.create-account', function(e) {
                if(!verified){
                    e.preventDefault();
                    let size_status = false;
                    let size_stock_count = 0;
                    let stock = $("#stock").val();
                    if($('#haveSize').is(":checked")){
                        size_status = true;
                        $('.size_stock').each(function(){
                            size_stock_count = +$(this).val() + size_stock_count;
                        });

                        if(stock == size_stock_count){
                            verified = true;
                            $(this).submit();
                            $('#errorMessage').css('display', 'none');
                        }else{
                            $('#errorMessage').css('display', 'block');
                        }
                    }else{
                        verified = true;
                        $(this).submit();
                    }


                }
            });
        });
    </script>
@endpush
