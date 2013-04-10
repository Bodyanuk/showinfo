<div class="sidebar left">

<div id="search">
<strong>Пошук</strong>

<form method="get" action="<?php bloginfo('home'); ?>/">
<input name="s" type="text" class="inputs" id="s" value="введіть слово.." onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"
			 size="12" />
</form>
</div><!--search-->

<?php if ( !function_exists('dynamic_sidebar')
		|| !dynamic_sidebar('sidebar 1') ) : ?>
<?php endif; ?>
</div><!--sidebar-->
