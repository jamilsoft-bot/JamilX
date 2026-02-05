<div class="w3-margin-top w3-blue-grey w3-container w3-bar">
                <span class="w3-bar-item w3-large">Statistics</span>
            </div>
            <div class="w3-container w3-margin-top">
                <h1>Testing environment 
                    
                <?php 
                $builtin = new JX_DateInterval();

                // $dt =  new DateTime();
                // $dt->sub(new DateInterval("P7D"));
                // //echo $dt->format("D M d, Y");
                $stat = new JP_Stats();

                echo $stat->Get_last2Days("d-m-y");
                
                
                ?>
            
            
            </h1>
                <div class="row">
                    <div class="col-md-3">
                        <div class="w3-padding w3-light-grey w3-center w3-round w3-margin-top w3-container">
                            <h2> <span class="  fas fa-chalkboard "></span> / <?php echo get_total_visits(); ?></h2>
                            <h4>Visits</h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="w3-padding w3-light-grey w3-center w3-round w3-margin-top w3-container">
                            <h2><span class=" fas fa-user-edit "></span> / <?php echo get_total_posts(); ?></h2>
                            <h4>Posts</h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="w3-padding w3-light-grey w3-center w3-round w3-margin-top w3-container">
                            <h2><h2><span class=" fas fa-file "></span> / <?php echo get_total_pages(); ?></h2>
                            <h4>Pages</h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="w3-padding w3-light-grey w3-center w3-round w3-margin-top w3-container">
                            <h2><span class=" fas fa-search "></span> / 200</h2>
                            <h4>Feedbacks</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w3-margin-top  w3-container w3-bar">
                <span class="w3-bar-item w3-large">Blog Analysis</span>
            </div>
            <div class="w3-container w3-bar w3-margin-top">
                <div class="w3-right">
                    <a class="w3-button w3-bar-item ">
                        <label class="w3-text-green">Choose Week</label>
                        <input type="week" class="w3-input" name="mt">
                    </a>
                </div>
            </div>
            <div class="w3-container w3-margin-top">
                    <div>
                    <canvas id="myChart"></canvas>
                  </div>
            </div>
            
<script src="Apps/jamilpress/assets/js/chart.js"></script>
<script>
    
       

const labels = [
  'Monday',
  'Tuesday',
  'Wednessday',
  'Thursday',
  'Friday',
  'Saturday',
  'Sunday',
];
const visits = {
    label: 'Visits',
    backgroundColor: 'green',
    borderColor: 'green',
    data: [0, 5, 15, 21, 30, 20, 15],
}


const comments = {
    label: 'Comments',
    backgroundColor: 'blue',
    borderColor: 'blue',
    data: [5, 28, 25, 28, 40, 26, 45],
}

const views = {
    label: 'Views',
    backgroundColor: 'rgb(255, 99, 132)',
    borderColor: 'rgb(255, 99, 132)',
    data: [15, 0, 19, 51, 70, 30, 25],
}
const data = {
  labels: labels,
  datasets: [
      visits,
      views,
      comments
  ]
};
const config = {
  type: 'line',
  data: data,
  options: {}
};
const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
    
</script>
