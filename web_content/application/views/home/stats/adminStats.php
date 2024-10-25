<h2>Admin Stats</h2>
<div class="analyse">
     <div class="sales">
         <div class="status">
             <div class="info">
                 <h3>Activities completed this month</h3>
                 <h1><?php echo $userStats['numActivitiesCompletedThisMonth']; ?></h1>
             </div>
             <div class="progress">
                 <svg>
                     <circle cx="38" cy="38" r="36"></circle>
                 </svg>
                 <div class="percentage">
                     <p>WIP</p>
                 </div>
             </div>
         </div>
     </div>
     <div class="visits">
         <div class="status">
             <div class="info">
                 <h3>Projects completed this month</h3>
                 <h1><?php echo $userStats['numProjectsCompletedThisMonth']; ?></h1>
             </div>
             <div class="progress">
                 <svg>
                     <circle cx="38" cy="38" r="36"></circle>
                 </svg>
                 <div class="percentage">
                     <p>WIP</p>
                 </div>
             </div>
         </div>
     </div>
     <div class="searches">
         <div class="status">
             <div class="info">
                 <h3>Users</h3>
                 <h1><?php echo $userStats['numUsers']; ?></h1>
             </div>
             <div class="progress">
                 <svg>
                     <circle cx="38" cy="38" r="36"></circle>
                 </svg>
                 <div class="percentage">
                     <p>WIP</p>
                 </div>
             </div>
         </div>
     </div>
</div>
