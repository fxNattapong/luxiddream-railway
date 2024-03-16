<link href="{{ asset('css/webpages/navbar.css') }}" rel="stylesheet">

<div class="z-50 container-fruid sticky top-0" style="background-color: #6d5092">
    <div class="navbar">
        <!-- START SIDEBAR -->
        <div id="mySidenav" class="sidenav">
            <span class="menu-bar">MENU</span>
            <button class="closebtn" onclick="closeNav()">&times;</button>
            <hr class="text-white" style="border: 1px solid white" />
            <a href="{{ Route('HomePage') }}">หน้าหลัก</a>
            <a href="{{ Route('RulePage') }}">กฎการเล่น</a>
            <a href="{{ Route('AboutPage') }}">เกี่ยวกับ</a>
            @if(Session::get('authen'))
                <a href="">กระทู้</a>
            @endif
            <a href="">คำถามที่พบบ่อย</a>
            <a href="{{ Route('Home') }}">เกม</a>
            <br />
        </div>
        <!-- END SIDEBAR -->

        <!-- START NAVBAR -->
        <div class="menu-items flex">
            <div class="logic whitespace-nowrap">
                <a href="#!">LUXID DREAM</a>
            </div>
            <ul class="whitespace-nowrap">
                <li>
                    <a href="{{ Route('HomePage') }}">หน้าหลัก</a>
                </li>
                <li>
                    <a href="{{ Route('RulePage') }}">กฎการเล่น</a>
                </li>
                <li>
                    <a href="{{ Route('AboutPage') }}">เกี่ยวกับ</a>
                </li>
                @if(Session::get('authen'))
                    <li>
                        <a href="">กระทู้</a>
                    </li>
                @endif
                <li>
                    <a href="">คำถามที่พบบ่อย</a>
                </li>
                <li>
                    <a href="{{ Route('Home') }}">เกม</a>
                </li>
            </ul>
        </div>

        <div class="d-flex align-items-center ml-auto mr-0 flex whitespace-nowrap">
            <span class="menu-icon me-auto" onclick="openNav()">&#9776;</span>
            <ul>
                <li class="no-hover">
                <select class="menu-items form-select bg-black border-0 rounded-full px-4 py-1.5">
                    <option [selected]="lang === 'en'" value="en">
                        ENG
                    </option>
                    <option [selected]="lang === 'th'" value="th">
                        THAI
                    </option>
                </select>
                </li>
                <li class="no-hover">
                    <a href="login" class="link-button px-4 py-1.5">เข้าสู่ระบบ</a>
                </li>
            </ul>
        </div>
        <!-- END NAVBAR -->
    </div>
</div>

<script>
    function openNav() {
        document.getElementById('mySidenav').style.width = '250px';
    }

    function closeNav() {
        document.getElementById('mySidenav').style.width = '0';
    }
</script>