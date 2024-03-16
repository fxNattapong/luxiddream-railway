<link href="{{ secure_asset('css/webpages/footer.css') }}" rel="stylesheet">

<footer class="footer">
  <div class="py-4 mx-auto">
    <div class="row grid grid-cols-3 max-md:grid-cols-1">
      <div class="col-md-4">
        <h4 class="topic_footer text-center text-white">เกี่ยวกับ</h4>
        <p class="mt-[1em] w-fit mx-auto text-gray-400">การปฐมพยาบาลด้านสุขภาพจิต: เว็บไซต์สำหรับทุกคนในการเรียนรู้</p>
      </div>
      <div class="col-md-4">
        <h4 class="topic_footer text-center text-white">ติดต่อ</h4>
        <ul class="mt-[1em] w-fit mx-auto text-gray-400">
          <li>อีเมล: XXXXXX@gmail.com</li>
          <li>เบอร์โทร: 090-XXX-XXXX</li>
          <li>เวลาทำการ: 9.00-18.00</li>
        </ul>
      </div>
      <div class="col-md-4">
        <h4 class="topic_footer text-center text-white">อื่น ๆ</h4>
        <ul class="mt-[1em] w-fit mx-auto text-gray-400">
          <li><a href="{{ Route('HomePage') }}" class="hover:text-blue-400 hover:underline">หน้าหลัก</a></li>
          <li><a href="{{ Route('RulePage') }}" class="hover:text-blue-400 hover:underline">กฏการเล่น</a></li>
          <li><a href="{{ Route('AboutPage') }}" class="hover:text-blue-400 hover:underline">เกี่ยวกับ</a></li>
          <li><a href="" class="hover:text-blue-400 hover:underline">กระทู้</a></li>
          <li><a href="" class="hover:text-blue-400 hover:underline">คำถามที่พบบ่อย</a></li>
          <li><a href="{{ Route('Home') }}" class="hover:text-blue-400 hover:underline">เกม</a></li>
        </ul>
      </div>
    </div>
    <hr class="my-[1em]">
    <div class="row text-white">
      <div class="col-md-12 text-center">
        <p class="copyright">© 2024 Mental Health First Aid</p>
      </div>
    </div>
  </div>
</footer>