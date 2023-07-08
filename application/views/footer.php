</div>
</main>

<footer class="footer">
	<div class="container-fluid">
		<div class="row text-muted">
			<div class="col-6 text-start">
				<p class="mb-0">
					<strong>Powered by: Sergio Ivan Galvis Esteban & Jhon Jairo Silva Fuentes Copyright © 2023</strong>
				</p>
			</div>
			<div class="col-6 text-end">
				<ul class="list-inline">

				</ul>
			</div>
		</div>
	</div>
</footer>
</div>
<script src="<?= base_url() ?>plantilla/js/app.js"></script>
<script>
	$(document).ready(function() {
		const menus = $(".sidebar-item");
		let bandera = 0;
		const menuActivo = $(".sidebar-item .sidebar-link").map(function() {
			if (this.href === window.location.href) {
				return bandera;
			}
			bandera++;
		}).get();
		menus[menuActivo].classList.add('active');


		var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
		var dropdownList = dropdownElementList.map(function(dropdownToggleEl) {
			return new bootstrap.Dropdown(dropdownToggleEl)
		})

	});
</script>

</body>

</html>