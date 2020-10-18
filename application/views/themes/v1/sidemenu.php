<nav class="pcoded-navbar">
						<div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
						<div class="pcoded-inner-navbar main-menu">
							<ul class="pcoded-item pcoded-left-item">
								<li class="<?php echo activate_dashboard((isset($_GET['clm']) ? $_GET['clm'] : 0), (isset($modul['id']) ? $modul['id'] : 0)); ?> ">
									<a href="<?php echo homepage() ?>">
										<span class="pcoded-micon"><i class="ti-desktop"></i><b>Module</b></span>
										<span class="pcoded-mtext">Dashboard Utama</span>
										<span class="pcoded-mcaret"></span>
									</a>
								</li>
							</ul>

							<?php foreach ((array) get_session('module_menu') as $key => $modul) { ?>
								<ul class="pcoded-item pcoded-left-item">
									<li class="pcoded-hasmenu <?php echo activate_modul((isset($_GET['clm']) ? $_GET['clm'] : 0), (isset($modul['id']) ? $modul['id'] : 0)); ?> ">
										<a href="javascript:void(0)">
											<span class="pcoded-micon"><i class="<?php echo $modul['module_icon']; ?>"></i><b>Module</b></span>
											<span class="pcoded-mtext"><?php echo $modul['name']; ?></span>
											<span class="pcoded-mcaret"></span>
										</a>
										<?php if (isset($modul['menu'])) { ?>
											<ul class="pcoded-submenu">
												<?php foreach ((array) $modul['menu'] as $key => $menu) { ?>
													<li class="<?php echo activate_menu((isset($_GET['clp']) ? $_GET['clp'] : 0), (isset($menu['id']) ? $menu['id'] : 0)) ?>  <?php echo ($menu['url'] == 'submenu' ? 'pcoded-hasmenu' : '') ?>">
														<?php if ($menu['url'] == '#' || $menu['url'] == 'submenu') { ?>
															<a href="javascript:void(0)">
															<?php } else { ?>
																<a href="<?php echo $menu['url'] ?>?clm=<?php echo $modul['id'] ?>&clp=<?php echo $menu['id'] ?>&cli=<?php echo $menu['id'] ?>">
																<?php } ?>
																<span class="pcoded-mtext"><?php echo $menu['name']; ?></span>
																<span class="pcoded-mcaret"></span>
																</a>
																<?php if (isset($menu['submenu1'])) { ?>
																	<ul class="pcoded-submenu">
																		<?php foreach ($menu['submenu1'] as $key2 => $submenu1) { ?>
																			<?php if ($_GET['clc']){ ?>
																				<li class="<?php echo activate_menu((isset($_GET['clc']) ? $_GET['clc'] : 0), (isset($submenu1['id']) ? $submenu1['id'] : 0)) ?> <?php echo ($submenu1['url'] == 'submenu' ? 'pcoded-hasmenu' : '') ?>" dropdown-icon="style3" subitem-icon="style7">
																			<?php }else{ ?>
																				<li class="<?php echo activate_menu((isset($_GET['cli']) ? $_GET['cli'] : 0), (isset($submenu1['id']) ? $submenu1['id'] : 0)) ?> <?php echo ($submenu1['url'] == 'submenu' ? 'pcoded-hasmenu' : '') ?>" dropdown-icon="style3" subitem-icon="style7">
																			<?php } ?>
																				<?php if ($submenu1['url'] == '#' || $submenu1['url'] == 'submenu') { ?>
																					<a href="javascript:void(0)">
																					<?php } else { ?>
																						<a href="<?php echo $submenu1['url'] ?>?clm=<?php echo $modul['id'] ?>&clp=<?php echo $menu['id'] ?>&cli=<?php echo $submenu1['id'] ?>">
																						<?php } ?>
																						<span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
																						<span class="pcoded-mtext"><?php echo $submenu1['name']; ?></span>
																						<span class="pcoded-mcaret"></span>
																						</a>
																						<?php if (isset($submenu1['submenu2'])) { ?>
																							<ul class="pcoded-submenu">
																								<?php foreach ($submenu1['submenu2'] as $key3 => $submenu2) { ?>
																									<li class="<?php echo activate_menu((isset($_GET['cli']) ? $_GET['cli'] : 0), (isset($submenu2['id']) ? $submenu2['id'] : 0)) ?> ">
																										<a href="<?= $submenu2['url'] ?>?clm=<?php echo $modul['id'] ?>&clp=<?php echo $menu['id'] ?>&clc=<?php echo $submenu1['id'] ?>&cli=<?php echo $submenu2['id'] ?>">
																											<span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
																											<span class="pcoded-mtext"><?php echo $submenu2['name']; ?></span>
																										</a>
																									</li>
																								<?php } ?>
																							</ul>
																						<?php } ?>
																			</li>
																		<?php } ?>
																	</ul>
																<?php } ?>
													</li>
												<?php } ?>
											</ul>
										<?php } ?>
									</li>
								</ul>
							<?php } ?>
						</div>
					</nav>
