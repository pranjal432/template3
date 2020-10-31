<div id="sidebar" style="background-color:slateblue;height:625px;"><div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->
			
            <h1 id="sidebar-title"><a href="examinee_panel.php">Examinee Panel</a></h1>
            
            <?php 
                $filename=basename($_SERVER['REQUEST_URI']);
                
                $testmenu=array('addtest.php','managetests.php');
                $usermenu=array('adduser.php','manageusers.php');
                $settingmenu=array('generalsettings.php');
                $accountmenu=array('manageaccount.php','signout.php');
            ?>
		  
			<!-- Logo (221px wide) -->
			       
			
			<ul id="main-nav">  <!-- Accordion Menu -->
				
				<li>
					<a href="examinee_panel.php" class="nav-top-item no-submenu <?php if($filename=="examinee_panel.php"): ?> current <?php endif; ?>"> <!-- Add the class "no-submenu" to menu items with no sub menu -->
						Dashboard
					</a>       
				</li>
				
				<li> 
                    <a href="taketest.php" class="nav-top-item <?php if(in_array($filename, $testmenu)): ?>current<?php endif; ?>"> <!-- Add the class "current" to current menu item -->
					Take Test
					</a>
					<ul>
                        
                        <?php

                        require "config.php";

                        $sql="SELECT * from tests";
                        $result=$conn->query($sql);
                        if($result->num_rows>0) {
                            while($row=$result->fetch_assoc()) {

                                $sql2="SELECT * from examineescore";
            $result2=$conn->query($sql2);
            if($result2->num_rows>0) {
                $count=0;
                while($row2=$result2->fetch_assoc()) {
                    if($row2['test_id']==$row['test_id']) {
                        $count++;
                        //echo $row2['test_id'];
                        //echo $row['test_id'];
                        //echo $count;
                        // $sql3="DELETE from examineescore WHERE test_id='".$row2['test_id']."'"; 
                        // if($conn->query($sql3)==true) {
                        //     echo '<form action="taketest1.php?testid='.$row["test_id"].'" method="POST">';
                        // }

                        // if($conn->query($sql3)==true) {
                        // echo '<form action="taketest1.php?testid='.$row["test_id"].'" method="POST">';

                            
						// }
						echo '<li><a';
                                echo '>'.$row['testname'].'</a></li>';
                    }
                    
                }
                
                if($count==0) {
                    echo '<li><a href="taketest1.php?testid='.$row['test_id'].'"';
                                if($filename=="taketest1.php?testid=".$row['test_id']."") { 
                                    echo ' class="current"';
                                }
                                echo '>'.$row['testname'].'</a></li>';
                }

            } else {
                echo '<li><a href="taketest1.php?testid='.$row['test_id'].'"';
                                if($filename=="taketest1.php?testid=".$row['test_id']."") { 
                                    echo ' class="current"';
                                }
                                echo '>'.$row['testname'].'</a></li>';
            }






                                
                            }
                        }

                        ?>
                        
					</ul>
				</li>
				
				
				
				
				
				
				<li>
					<a href="#" class="nav-top-item <?php if(in_array($filename, $settingmenu)): ?>current<?php endif; ?>">
						Settings
					</a>
					<ul>
						<li><a href="generalsettings1.php" <?php if($filename=="generalsettings.php"): ?> class="current" <?php endif; ?>>General</a></li>
						
					</ul>
                </li> 
                
                <li>
					<a href="#" class="nav-top-item <?php if(in_array($filename, $accountmenu)): ?>current<?php endif; ?>">
						Account
					</a>
					<ul>
						
                        <li><a href="manageaccount1.php" <?php if($filename=="manageaccount.php"): ?> class="current" <?php endif; ?>>Manage Account</a></li>
                        <li><a href="signout1.php" <?php if($filename=="signout.php"): ?> class="current" <?php endif; ?>>Sign out</a></li>
					</ul>
				</li>
				
			</ul> <!-- End #main-nav -->
			
			<div id="messages" style="display: none"> <!-- Messages are shown when a link with these attributes are clicked: href="#messages" rel="modal"  -->
				
				<h3>3 Messages</h3>
			 
				<p>
					<strong>17th May 2009</strong> by Admin<br />
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue.
					<small><a href="#" class="remove-link" title="Remove message">Remove</a></small>
				</p>
			 
				<p>
					<strong>2nd May 2009</strong> by Jane Doe<br />
					Ut a est eget ligula molestie gravida. Curabitur massa. Donec eleifend, libero at sagittis mollis, tellus est malesuada tellus, at luctus turpis elit sit amet quam. Vivamus pretium ornare est.
					<small><a href="#" class="remove-link" title="Remove message">Remove</a></small>
				</p>
			 
				<p>
					<strong>25th April 2009</strong> by Admin<br />
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue.
					<small><a href="#" class="remove-link" title="Remove message">Remove</a></small>
				</p>
				
				<form action="#" method="post">
					
					<h4>New Message</h4>
					
					<fieldset>
						<textarea class="textarea" name="textfield" cols="79" rows="5"></textarea>
					</fieldset>
					
					<fieldset>
					
						<select name="dropdown" class="small-input">
							<option value="option1">Send to...</option>
							<option value="option2">Everyone</option>
							<option value="option3">Admin</option>
							<option value="option4">Jane Doe</option>
						</select>
						
						<input class="button" type="submit" value="Send" />
						
					</fieldset>
					
				</form>
				
			</div> <!-- End #messages -->
			
		</div></div> <!-- End #sidebar -->