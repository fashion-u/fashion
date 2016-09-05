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
							<li><a href="/about">О проекте</a></li>
							<li><a href="/brands_and_shops">Бренды и магазины</a></li>
							<li><a href="/user-license">Пользовательское соглашение</a></li>
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
                                    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                                <?php } ?>
                              <?php } ?>
                          </ul>
                      </nav>
                      <!--end breadcrumbs-->
                      
                      	<!--alphabet section-->
							<section class="alphabet-section">
								<div class="big-title"><?php echo $heading_title; ?></div>
								<?php echo $description; ?> 
								<!--div class="alphabet-line">
									<a href="#">0–9</a>
									<a href="#">A</a>
									<a href="#">B</a>
									<a href="#">C</a>
									<a href="#">D</a>
									<a href="#">E</a>
									<a href="#">F</a>
									<a href="#">G</a>
									<a href="#">H</a>
									<a href="#">I</a>
									<a href="#">J</a>
									<a href="#">K</a>
									<a href="#">L</a>
									<a href="#">M</a>
									<a href="#">N</a>
									<a href="#">O</a>
									<a href="#">P</a>
									<a href="#">Q</a>
									<a href="#">R</a>
									<a href="#">S</a>
									<a href="#">T</a>
									<a href="#">U</a>
									<a href="#">V</a>
									<a href="#">W</a>
									<a href="#">X</a>
									<a href="#">Y</a>
									<a href="#">Z</a>
									<a href="#">А–Я</a>
								</div-->
								<?php $first_letter = ''; $count_mem = count($brands); $count = ceil($count_mem / 3); ?>
								<div class="alphabet-list clearfix">
									
									<!--div class="letter left">A</div-->
									<div class="column left">
										<ul>
											
										<?php foreach($brands as $brand){ ?>
									
											<li><a href="<?php echo $brand['href']; ?>"><?php echo $brand['name']; ?></a></li>
											
											<?php
												$count--; 
												if($count < 1){
												$count = ceil($count_mem / 3); ?>
										
													</ul>
												</div>
												<div class="column left">
													<ul>
										
											<?php } ?>
											
											
										<?php } ?>
										</ul>
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
