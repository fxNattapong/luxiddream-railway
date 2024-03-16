<title>Home | LuxidDream</title>

@extends('webpages.layouts.Layout')

@section('Content')
  <link href="{{ asset('css/webpages/homepage.css') }}" rel="stylesheet">

  <div class="banner flex items-center justify-center">
    <div class="story">
      <div class="grid grid-cols-2">
        <div>
          <h1 class="pt-6 text-5xl">Luxid Dream</h1>
          <div class="pt-6 text-xl text-white">
            <p>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ในปี 253 ME (ยุคเทพนิยาย) 
              อาณาจักรเวทมนตร์เป็นดินแดนในฝันที่สิ่งมีชีวิตทุกชนิดอาศัยอยู่ร่วมกันอย่างสงบสุข <br />
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;น่าเสียดายที่มีโรคในตำนานแพร่กระจาย Luxid Dream 
              ทำให้ผู้ป่วยไม่สามารถตื่นได้ ด้วยความช่วยเหลือจาก Dream Travellers 
              พวกเขากำลังค้นหาสาเหตุของการเจ็บป่วยและรักษาสิ่งมีชีวิตที่ได้รับผลกระทบ <br />
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ใน Luxid Dream ผู้เล่นจะเล่นเป็น Dream Travellers 
              ที่สามารถเดินทางระหว่าง Dream และ Reality เพื่อเรียนรู้เกี่ยวกับฝันร้าย
              และพยายามค้นหาความสงบเพื่อให้ผู้ป่วยสามารถตื่นขึ้นมาอย่างเต็มใจ
            </p>
          </div>
        </div>
        <div class="flex justify-center items-center">
          <img
            class="img-fluid"
            src="../../../assets/images/item-11.png"
            width="500"
            height="500" />
        </div>
      </div>
    </div>
  </div>
@endsection