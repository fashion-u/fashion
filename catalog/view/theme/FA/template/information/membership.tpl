<?php echo $header; ?>

  <!--content section-->
  <section class="content-section">
      <div class="inner-block">

          <div class="special-row clearfix">
              <!--sidebar-->
              <section class="sidebar left">

                  <!--category menu-->
                  <nav class="category-menu">
                      <ul>
							<li><a href="http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?>about">О проекте</a></li>
							<li><a href="http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?>brands_and_shops">Бренды и магазины</a></li>
							<li><a href="http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?>user-license">Пользовательское соглашение</a></li>
                      </ul>
                  </nav>
                  <!--end category menu-->

              </section>
              <!--end sidebar-->
              
              
            <!--cont-->
              <section class="cont right">
                  <div class="inner-special-box special">

                      <!--breadcrumbs-->
                      <nav class="breadcrumbs inline mobile-off">
                          <ul class="clearfix">
                              <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                                <?php if($breadcrumb['href'] == ''){ ?>
                                    <li><?php echo $breadcrumb['text']; ?></li>
                                <?php }else{ ?>
                                    <li><a href="http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?><?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                                <?php } ?>
                              <?php } ?>
                          </ul>
                      </nav>
                      <!--end breadcrumbs-->
                      
                      	<!--alphabet section-->
							<section class="alphabet-section">
								<div class="big-title"><?php echo $heading_title; ?></div>
								<?php echo $description; ?> 
								
								<div class="alphabet-list clearfix">
									
									<!--div class="letter left">A</div-->
									<div class="column left">
								
										<table class="contacts">
											<tbody>
												<tr>
													<td class="text-center" style="vertical-align: top;"><img alt="" height="44" src="/image/membership/membership1.png" width="88"><br><b>88x44</b></td>
													<td rowspan="4" style="width: 20px;">&nbsp;</td>
													<td>
														<textarea cols="60" name="partners_textarea1" rows="2" class="partners_textarea">&lt;a href="<?php echo HTTP_SERVER; ?>" target="_blank"&gt;&lt;img align="center" alt="fashion-u.com.ua" height="44" src="<?php echo HTTP_SERVER; ?>image/membership/membership1.png" width="88" /&gt;&lt;/a&gt;</textarea></td>			
												</tr>
												<tr>
													<td class="text-center" style="vertical-align: top;"><img alt="" height="44" src="/image/membership/membership2.png" width="88"><br><b>88x44</b></td>
													<td>
														<textarea cols="60" name="partners_textarea2" rows="2" class="partners_textarea">&lt;a href="<?php echo HTTP_SERVER; ?>" target="_blank"&gt;&lt;img align="center" alt="fashion-u" height="44" src="<?php echo HTTP_SERVER; ?>image/membership/membership2.png" width="88" /&gt;&lt;/a&gt;</textarea></td>
												</tr>
												<tr>
													<td class="text-center" style="vertical-align: top;"><img alt="" height="44" src="/image/membership/membership3.png" width="88"><br><b>88x44</b></td>
													<td>
														<textarea cols="60" name="partners_textarea3" rows="2" class="partners_textarea">&lt;a href="<?php echo HTTP_SERVER; ?>" target="_blank"&gt;&lt;img align="center" alt="fashion-u" height="44" src="<?php echo HTTP_SERVER; ?>image/membership/membership3.png" width="88" /&gt;&lt;/a&gt;</textarea></td>
												</tr>
												<tr>
													<td class="text-center" style="vertical-align: top;"><img alt="" height="44" src="/image/membership/membership4.png" width="88"><br><b>88x44</b></td>
													<td>
														<textarea cols="60" name="partners_textarea4" rows="2" class="partners_textarea">&lt;a href="<?php echo HTTP_SERVER; ?>" target="_blank"&gt;&lt;img align="center" alt="fashion-u.com.ua" height="44" src="<?php echo HTTP_SERVER; ?>image/membership/membership4.png" width="88" /&gt;&lt;/a&gt;</textarea></td>
												</tr>
											</tbody>
										</table>
								
<style>
	table {
		max-width: 100%;
		background-color: transparent;
		border-spacing: 0;
		border-collapse: collapse;
		border-color: grey;
	}
	.contacts td {
		border: none !important;
		color: #5c5c5c;
		font-size: 15px;
	}
	textarea.partners_textarea {
		width: 840px;
		margin-bottom: 20px;
		padding: 20px 10px 10px 20px;
	}
	textarea {
		font-family: inherit;
		font-size: inherit;
		line-height: inherit;
		overflow: auto;
		color: #2D2D2D;
	}
	.contacts b {
		color: #999;
		font-weight: normal;
		font-size: 15px;
	}
	.text-center {
		text-align: center;
	}
	td, th {
		padding: 0;
	}
	img {
		vertical-align: middle;
	}
</style>
									
									</div>
								</div>
							</section>
							<!--end alphabet section-->

                      
                  </div>
              </section>
          </div>

      </div>
  </section>

<?php echo $footer; ?>
