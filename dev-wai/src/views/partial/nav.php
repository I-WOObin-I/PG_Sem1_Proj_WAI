<nav>
        <div id="navbutback">
            <div class="drop">
                <button id="navbut0" onclick="navbut0click()"> = </button>
                <div id="dropcont">
                    <a href="/index.html"   class="navbut">aktualnosci  </a>
                    <a href="/deski.html"   class="navbut">deski        </a>
                    <a href="/miejsca.html" class="navbut">miejsca      </a>
                    <a href="/zawodowe.html"class="navbut">zawodowe     </a>
                    <a href="products"      class="navbut">sklep        </a>
                    <a href="/eventy.html"  class="navbut">eventy       </a>
                    <a href="/kontakt.html" class="navbut">kontakt      </a>
                </div>
            </div>
            <a href="/index.html"       class="navbut" id="navbut1"> aktualnosci</a>
            <a href="/deski.html"       class="navbut" id="navbut2"> deski      </a>
            <a href="/miejsca.html"     class="navbut" id="navbut3"> miejsca    </a>
            <a href="/zawodowe.html"    class="navbut" id="navbut4"> zawodowe   </a>
            <a href="products"          class="navbut" id="navbut5"> sklep      </a>
            <a href="/eventy.html"      class="navbut" id="navbut6"> eventy     </a>

            <?php if(!isset($user['login']) || $user['login']==''): ?>
            <a href="login">
            <?php else: ?>
            <a href="user">
                <span class="login_text"><?= $user['login'] ?></span>
            <?php endif?>
            <div id="login_but">
                <img src="src_img/login_guy.png" id="login_guy"/>
            </div>
            </a>
        </div>
</nav>