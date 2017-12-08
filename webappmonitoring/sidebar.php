<?php

?>

            <nav id="spy">
                <ul class="nav sidebar-nav">
				
                    <li class="sidebar-brand">
                        <a  href="index.php">
							 <img class="image-brand" src="public/img/owtel-116.png" />
						</a>
						
                    </li>
					
					<div class="top-line">
						<hr>
					</div>
					
					<li class="<?php if(strtoupper(basename($_SERVER['SCRIPT_NAME'])) == "DASHBOARD.PHP"){echo "active";}else{echo '';}?>">
						<a href="dashboard.php">
							<i class="glyphicon glyphicon-menu-hamburger"></i> 
							Dashboard
						</a>
							
					</li>
					
					<li data-toggle="collapse" data-target="#sidebar-dropdown" class="sidebar-dropdown <?php if(strtoupper(basename($_SERVER['SCRIPT_NAME'])) == "APPLICATION.PHP"){echo "active";}else{echo '';}?>">
						<a href="#">
							<i class="glyphicon glyphicon-cog"></i> 
							Settings
						</a>
						<ul id="sidebar-dropdown" class="<?php if(strtoupper(basename($_SERVER['SCRIPT_NAME'])) == "APPLICATION.PHP"){echo "collapse in";}else{echo '';}?> collapse list-unstyled">
							<li><a href="application.php">Application</a></li>
						</ul>
					</li>
					
					<div class="bottom-line">
						<hr>
					</div>
                   
                </ul>
            </nav>
        
