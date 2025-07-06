    </main>
    <footer>
        <p>&copy; <?= date('Y') ?> e-ProTrack - Monitoring</p>
    </footer>
    <script src="public/assets/js/app.js"></script>
</body>
</html>

<script>
  window.APP_TITLE = "<?= $Title ?>"; 
  document.title = window.APP_TITLE;

  window.META_DESC = "<?= $Meta_Desc ?>";
  const metaDesc = document.querySelector('meta[name="description"]');
  metaDesc.content = window.META_DESC;
</script>