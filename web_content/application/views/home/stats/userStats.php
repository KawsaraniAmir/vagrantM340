<h2>User Stats</h2>
<div class="analyse">
     <div class="sales">
         <div class="status">
             <div class="info">
                 <h3>Hours worked this month</h3>
                 <h1><?php echo $userStats['totalHoursThisMonth']; ?></h1>
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
                 <h3>Hours worked in total</h3>
                 <h1><?php echo $userStats['totalHours']; ?></h1>
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
                 <h3>Monthly Activities</h3>
                 <h1><?php echo $userStats['numActivitiesThisMonth']; ?></h1>
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
