@extends('layouts.app')
@section('headend')
@endsection
@section('bodyclass', 'bg-img mapfull')
@section('content')
    <section class="list-products" style="margin-top: 149px;">
        <div class="wrapper">
            <div class="list-container">
                <div class="list-box">
                    <livewire:members.shared.left-nav key="left-nav-{{ now()->timestamp }}"  :row="collect($row)->toArray()"/>
                    <div class="products-links">
                        <livewire:members.profiles.profile-component key="profile-component-{{ now()->timestamp }}" />
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('bodyend')
    <script>
        $(document).ready(function() {
            $('body').on('keyup', '#search-box-post', function(e) {
                console.log('TT');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();
                if (parseInt($(this).val().length) == 0) {
                    $("#suggesstion-box").hide();
                    $("#suggesstion-box").html('');
                    window.livewire.emitTo('members.profiles.profile-edit', 'setLocationMyProfile', '', '',
                        '');
                }
                if (parseInt($(this).val().length) >= 2) {
                    $.ajax({
                        type: "POST",
                        url: "{{ url('api/search-location') }}",
                        data: 'type=post&location=' + $(this).val(),
                        beforeSend: function() {},
                        success: function(data) {
                            $("#suggesstion-box").show();
                            $("#suggesstion-box").html(data);
                        }
                    });
                } //end
            });
            $('body').on('click', '.search-list-post', function(event) {
                event.preventDefault();
                const id = $(this).attr('data-id');
                const name = $(this).attr('data-name');
                const type = $(this).attr('data-type');
                window.livewire.emitTo('members.profiles.profile-edit', 'setLocationMyProfile', id, name,
                    type);
                $("#search-box-post").val(name);
                $("#suggesstion-box").hide();
            });
        });
    </script>
@endsection
