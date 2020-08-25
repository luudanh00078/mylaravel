@extends('layouts.master')

@section('NoiDung')
    <h1>PHP superside</h1>
    {{--{!!$khoahoc!!}--}}
    {{--Day la chu thich comment--}}
    {{--bai22--}}
    {{--
    @if($khoahoc != "")
    {{$khoahoc}}
    @else
    {{"khong co khoa hoc"}}
    @endif
    

    {{$khoahoc or "khong co khoa hoc nao "}}

    <br>

    @for($i = 1; $i <= 10; $i++)
    {{$i. " "}}
    @endfor 
    --}}
    {{--bai23--}}
    <?php $lophoc = array("Laravel","PHP","ASP.net","java"); ?>
    {{--
    @if(!empty($lophoc))
        @foreach($lophoc as $value)
        {{$value}}
        @endforeach
    @else 
        {{"Mang rong"}}
    @endif
    --}}
    {{--giai quyet van de tren ngan gon hon voi forelse--}}
    @forelse($lophoc as $value)
        @continue($value == "Laravel")
        @break($value == "ASP.net")
       {{$value}}
    @empty
       {{"Mang khong co gia tri"}}
    @endforelse

@endsection