<?php/*Template Name: Contact Form*/?><?php //If the form is submittedif(isset($_POST['submitted'])) {	//Check to see if the honeypot captcha field was filled in	if(trim($_POST['checking']) !== '') {		$captchaError = true;	} else {			//Check to make sure that the name field is not empty		if(trim($_POST['contactName']) === '') {			$nameError = 'Вы забыли ввести ваше имя.';			$hasError = true;		} else {			$name = trim($_POST['contactName']);		}				//Check to make sure sure that a valid email address is submitted		if(trim($_POST['email']) === '')  {			$emailError = 'Вы забыли ввести ваш email.';			$hasError = true;		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {			$emailError = 'Вы ввели неверный  email.';			$hasError = true;		} else {			$email = trim($_POST['email']);		}					//Check to make sure comments were entered			if(trim($_POST['comments']) === '') {			$commentError = 'Вы забыли ввести ваш комментарий';			$hasError = true;		} else {			if(function_exists('stripslashes')) {				$comments = stripslashes(trim($_POST['comments']));			} else {				$comments = trim($_POST['comments']);			}		}					//If there is no error, send the email		if(!isset($hasError)) {			$emailTo = 'me@somedomain.com';			$subject = 'Контактная форма представлена как '.$name;			$sendCopy = trim($_POST['sendCopy']);			$body = "Имя: $name \n\nEmail: $email \n\Комментарий: $comments";			$headers = 'С: Мой сайт <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;						mail($emailTo, $subject, $body, $headers);			if($sendCopy == true) {				$subject = 'Сообщение с сайта';				$headers = 'From: Your Name <noreply@somedomain.com>';				mail($email, $subject, $body, $headers);			}			$emailSent = true;		}	}} ?><?php get_header();?><?php get_sidebar('left');?><div id="main-container"><?php if(isset($emailSent) && $emailSent == true) { ?>	<div class="thanks">		<h1>Спасибо, <?=$name;?></h1>		<p>Ваше сообщение было успешно отправлено. Оно вскоре дойдет.</p>	</div><?php } else { ?>	<?php if (have_posts()) : ?>		<?php while (have_posts()) : the_post(); ?>			<div class="post-row">	<div class="post-title insingle"><a href="<?php the_permalink();?>"><?php the_title();?></a></div> 	<div class="post-content">	<?php the_content();?>	</div><!--post-content-->	</div><!--post-row-->					<?php if(isset($hasError) || isset($captchaError)) { ?>			<p class="error">Обнаружена ошибка при отправке формы.<p>					<?php } ?>			<form action="<?php the_permalink(); ?>" id="contactForm" method="post">				<ol class="forms">				<li><label class="comment-form-labels name" for="contactName">Имя </label>					<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="requiredField" />					<?php if($nameError != '') { ?>						<span class="error"><?=$nameError;?></span> 					<?php } ?>				</li>								<li><label for="email">Email</label>					<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="requiredField email" />					<?php if($emailError != '') { ?>						<span class="error"><?=$emailError;?></span>					<?php } ?>				</li>								<li class="textarea"><label for="commentsText">Комментарии </label>					<textarea name="comments" id="commentsText" cols="40" rows="15" class="requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>					<?php if($commentError != '') { ?>						<span class="comment"><?=$commentError;?></span> 					<?php } ?>				</li>				<li class="inline"><input type="checkbox" name="sendCopy" id="sendCopy" value="true"<?php if(isset($_POST['sendCopy']) && $_POST['sendCopy'] == true) echo ' checked="checked"'; ?> /><label for="sendCopy">Отправить копию этого сообщения вам</label></li>				<li class="screenReader"><label for="checking" class="screenReader">Если вы хотите отправить эту форму, не вводите ничего в этом поле</label><input type="text" name="checking" id="checking" class="screenReader" value="<?php if(isset($_POST['checking']))  echo $_POST['checking'];?>" /></li>				<li class="buttons"><input type="hidden" name="submitted" id="submitted" value="true" /><button type="submit">Сообщение мне &raquo;</button></li>			</ol>		</form>		<?php endwhile; ?>	<?php endif; ?><?php } ?></div><!--main-container--><?php get_sidebar('right'); ?><?php get_footer();?>