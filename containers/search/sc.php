
<?php

include "header.php";
    if(isset($_COOKIE['visited'])){
        
    }else{
        
        echo "<script>";
        echo "location.assign('about')";
        echo "</script>";
    }

    addHit("visitor",'search');  
?>
<div class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-slate-800 px-4 py-16">
      <form action="search" method="post" class="mx-auto max-w-2xl">
        <div class="rounded-3xl border border-slate-800 bg-slate-950/70 p-8 shadow-2xl">
          <div class="flex flex-col items-center gap-6 text-center">
            <img src="assets/images/lg.png" class="h-20 w-20 rounded-2xl bg-white/10 p-3" alt="Jamilsoft logo">
            <div>
              <h1 class="text-2xl font-semibold text-white sm:text-3xl">Find everything across JamilX</h1>
              <p class="mt-2 text-sm text-slate-400">Search apps, businesses, posts, and more from one place.</p>
            </div>
          </div>
          <div class="mt-8 flex flex-col gap-3">
            <label for="q" class="text-sm font-medium text-slate-200">Search</label>
            <div class="flex items-center gap-3 rounded-2xl border border-slate-700 bg-slate-900/70 px-4 py-3">
              <input class="w-full bg-transparent text-base text-slate-100 placeholder:text-slate-500 focus:outline-none" name='q' id="q"  type="text" placeholder="Type to search..." />
              <button class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-500" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                </svg>
                Search
              </button>
            </div>
          </div>
          <div class="mt-6 flex flex-wrap items-center justify-center gap-3 text-xs font-semibold uppercase tracking-wide text-slate-400">
            <a href="about" class="rounded-full border border-slate-700 px-4 py-2 transition hover:border-blue-500 hover:text-blue-300">About us</a>
            <a href="addbus" class="rounded-full border border-slate-700 px-4 py-2 transition hover:border-blue-500 hover:text-blue-300">Add Business</a>
            <a href="about#contact" class="rounded-full border border-slate-700 px-4 py-2 transition hover:border-blue-500 hover:text-blue-300">Contact us</a>
          </div>
          <div class="mt-8 border-t border-slate-800 pt-6 text-center text-sm text-slate-400">
            <?php
             
             //echo session_status();
            global $Me, $SUID;

            echo "<a href='me' class='font-semibold text-white hover:text-blue-300'>". $Me->username() ."</a>";
             
            if(isset($_SESSION['uid'])){
                  echo "<div class='mt-2'><a href='passgate?action=logout' class='text-slate-400 hover:text-blue-300'>Sign out</a></div>";
                 // echo $_SESSION['uid'];
            }else{
              echo "<div class='mt-2'><a href='login' class='text-slate-400 hover:text-blue-300'>Sign in</a></div>";
            }

            ?>
            <p id="cp" class="mt-6 text-xs uppercase tracking-[0.2em] text-slate-500">&copy;2021 Jamilsoft Technologies</p>
          </div>
        </div>
      </form>
    </div>

    
    <script src="assets/js/choices.js"></script>
    <script>
      dc = document.getElementById('cp');
      dat = new Date();
      dc.innerHTML = "&copy; 2020-" + dat.getFullYear() + " Jamilsoft Technologies";
      var textPresetVal = new Choices('#q',
      {
        removeItemButton: true,
      });

    </script>

    <?php 

include "footer.php";?>
