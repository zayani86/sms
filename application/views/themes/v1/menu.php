<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<nav class="pcoded-navbar">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?php echo activate_dashboard((isset($_GET['clm']) ? $_GET['clm'] : 0)  , (isset($modul['id']) ? $modul['id'] : 0)); ?> ">     
                <a href="<?php echo homepage() ?>">
                    <span class="pcoded-micon"><i class="icofont icofont-computer"></i><b>Modul</b></span>
                    <span class="pcoded-mtext">Dashboard</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>                

        <?php  foreach ((array) get_session('module_menu') as $key => $modul) {?>
            <ul class="pcoded-item pcoded-left-item">
                    <li class="pcoded-hasmenu <?php echo activate_modul((isset($_GET['clm']) ? $_GET['clm'] : 0)  , (isset($modul['id']) ? $modul['id'] : 0)); ?> ">                                    
                    <a href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="<?php echo $modul['module_icon']; ?>"></i><b>Modul</b></span>
                        <span class="pcoded-mtext"><?php echo $modul['name']; ?></span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                    <?php if (isset($modul['menu'])) { ?>   
                        <ul class="pcoded-submenu">
                        <?php foreach ((array) $modul['menu'] as $key => $menu) { ?>
                                <li class="<?php echo activate_menu((isset($_GET['clp']) ? $_GET['clp'] : 0)  , (isset($menu['id']) ? $menu['id'] : 0)) ?> ">       
                                        <?php if ($menu['url']=='#') { ?>
                                            <a href="javascript:void(0)">
                                        <?php } else { ?>
                                            <a href="<?php echo $menu['url']?><?php echo submenu_url($menu['url']=='submenu' ? $menu['id'] : '') ?>?clm=<?php echo $modul['id'] ?>&clp=<?php echo $menu['id'] ?>&cli=<?php echo $menu['id'] ?>">
                                        <?php } ?>
                                        <span class="pcoded-mtext"><?php echo $menu['name']; ?></span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                        <?php } ?>                                
                        </ul>
                    <?php } ?>  
                </li>
            </ul>
        <?php }?>
    </div>
</nav>