	</main>
<?php if ($_GET['url'] == 'page' || $_GET['url'] == 'post') {?>
	<aside class="arrow" id="right">Older&gt;<aside>
<?php } ?>
</section>
<?php require_once "./Src/Templates/footer.php"; ?>
	<script
		src="https://code.jquery.com/jquery-3.3.1.min.js"
		integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
		crossorigin="anonymous"></script>

<script type="text/javascript">
  if (typeof jQuery == 'undefined')
  {
     document.write(unescape("%3Cscript src='/Src/Js/jquery-3.3.1.min.js' %3E%3C/script%3E"));
  }
  </script>


<?php if ($_GET['url'] == 'page') {?>
  <script src="/Src/Js/index.js"></script>
<?php } else if ($_GET['url'] == 'post') {?>
  <script src="/Src/Js/fullPost.js"></script>
<?php } ?>
</body>
</html>