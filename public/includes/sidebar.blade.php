<!-- Sidebar -->
<div class="sidebar sidebar-style-2" data-background-color="<?php echo Auth::user()->cor_sidebar?>">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="<?php echo route('home')?>/img/profile/<?php echo Auth::user()->profile_photo_path?>"
                         alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									<?php echo Auth::user()->name?>
									<span class="user-level">Administrador</span>
									<span class="caret"></span>
								</span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#profile">
                                    <span class="link-collapse">Meu perfil</span>
                                </a>
                            </li>
                            <li>
                                <a href="#edit">
                                    <span class="link-collapse">Editar perfil</span>
                                </a>
                            </li>
                            <li>
                                <a href="#settings">
                                    <span class="link-collapse">Configurações</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <!--                <li class="nav-item active">-->
                <!--                    <a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">-->
                <!--                        <i class="fas fa-home"></i>-->
                <!--                        <p>Dashboard</p>-->
                <!--                        <span class="caret"></span>-->
                <!--                    </a>-->
                <!--                    <div class="collapse" id="dashboard">-->
                <!--                        <ul class="nav nav-collapse">-->
                <!--                            <li>-->
                <!--                                <a href="demo1/index.html">-->
                <!--                                    <span class="sub-item">Dashboard 1</span>-->
                <!--                                </a>-->
                <!--                            </li>-->
                <!--                            <li>-->
                <!--                                <a href="demo2/index.html">-->
                <!--                                    <span class="sub-item">Dashboard 2</span>-->
                <!--                                </a>-->
                <!--                            </li>-->
                <!--                        </ul>-->
                <!--                    </div>-->
                <!--                </li>-->
                <li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
                    <h4 class="text-section">Componentes</h4>
                </li>
                <li class="nav-item <?php echo $MODULO == "obras" ? "active submenu" : ""?>">
                    <a data-toggle="collapse"
                       href="#obras" <?php echo $MODULO == "obras" ? "class aria-expanded='true'" : ""?>>
                        <i class="fas fa-hammer"></i>
                        <p>&nbsp;&nbsp;Obras</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse <?php echo $MODULO == "obras" ? "show" : ""?>" id="obras">
                        <ul class="nav nav-collapse">
                            <li <?php echo $MODULO == "obras" && $func == 'gerenciar' ? "class='active'" : ""?>>
                                <a href="<?php echo route('obras.ativas');?>">
                                    <span class="sub-item">Obras Ativas</span>
                                </a>
                            </li>
                            <li <?php echo $MODULO == "obras" && $func == 'listar' ? "class='active'" : ""?>>
                                <a href="<?php echo route('obras.show');?>">
                                    <span class="sub-item">Ver obras</span>
                                </a>
                            </li>
                            <li <?php echo $MODULO == "obras" && $func == 'criar' ? "class='active'" : ""?>>
                                <a href="<?php echo route('obras.criar');?>">
                                    <span class="sub-item">Criar obras</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item <?php echo $MODULO == "funcionarios" ? "active submenu" : ""?>">
                    <a data-toggle="collapse"
                       href="#funcionarios" <?php echo $MODULO == "funcionarios" ? "class aria-expanded='true'" : ""?>>
                        <i class="fas fa-hard-hat"></i>
                        <p>&nbsp;&nbsp;Funcionários</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse <?php echo $MODULO == "funcionarios" ? "show" : ""?>" id="funcionarios">
                        <ul class="nav nav-collapse">
                            <li <?php echo $MODULO == "funcionarios" && $func == 'listar' ? "class='active'" : ""?>>
                                <a href="<?php echo route('funcionarios.show');?>">
                                    <span class="sub-item">Ver funcionários</span>
                                </a>
                            </li>
                            <li <?php echo $MODULO == "funcionarios" && $func == 'criar' ? "class='active'" : ""?>>
                                <a href="<?php echo route('funcionarios.criar');?>">
                                    <span class="sub-item">Criar funcionários</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item <?php echo $MODULO == "clientes" ? "active submenu" : ""?>">
                    <a data-toggle="collapse"
                       href="#clientes" <?php echo $MODULO == "clientes" ? "class aria-expanded='true'" : ""?>>
                        <i class="fas fa-user"></i>
                        <p>&nbsp;&nbsp;Clientes</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse <?php echo $MODULO == "clientes" ? "show" : ""?>" id="clientes">
                        <ul class="nav nav-collapse">
                            <li <?php echo $MODULO == "clientes" && $func == 'listar' ? "class='active'" : ""?>>
                                <a href="<?php echo route('clientes.show');?>">
                                    <span class="sub-item">Ver clientes</span>
                                </a>
                            </li>
                            <li <?php echo $MODULO == "clientes" && $func == 'criar' ? "class='active'" : ""?>>
                                <a href="<?php echo route('clientes.criar');?>">
                                    <span class="sub-item">Criar clientes</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
