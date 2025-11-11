<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>About Us | Amrich</title>
  <link rel="stylesheet" href="../assets/css/about.css" />
  <link rel="stylesheet" href="../landing-navbar.css">
  <link rel="stylesheet" href="../assets/css/footer.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>

  </style>
</head>
<body>
  <?php include 'landing-navbar.php'; ?>

  <section class="hero-section">
    <div class="container">
      <h1>About us</h1>
      <p>
        We are a team of passionate individuals committed to delivering digital solutions for the modern world.
      </p>
    </div>
  </section>

  <section class="mission">
    <div class="container">
      <h2>Our Mission</h2>
      <p>
        Our mission is to create impactful digital experiences through innovative technology and human-centered design.
        Over the years, we've completed numerous successful projects, collaborated with various industries, and delivered consistent, high-quality work.
      </p>
    </div>
  </section>

  <hr style="margin-top:-2.5rem;">

  <section class="timeline">
    <div class="container">
      <h2>Yearly Achievements</h2>
      <canvas id="achievementsChart"></canvas>
    </div>
  </section>

  <section class="team">
    <div class="container">
      <h2>Meet our Key Team Members</h2>
      <div class="team-members">
        <div class="member" tabindex="0">
          <img src="../assets/images/ceo.jpg" alt="Rajesh Rana" />
          <h3>Rajesh Rana</h3>
          <p>Founder, Chief Executive Officer</p>
        </div>
        <div class="member" tabindex="0">
          <img src="../assets/images/suman.jpg" alt="Suman Mondal" />
          <h3>Suman Mondal</h3>
          <p>Supervisor - Newtown</p>
        </div>
        <div class="member" tabindex="0">
          <img src="../assets/images/demo-img.jpg" alt="Subir Das" />
          <h3>Subir Das</h3>
          <p>Supervisor - Sealdah</p>
        </div>
      </div>
    </div>
  </section>
  <script>
    // Animate numbers for the chart (for visual enhancement)
    function animateBarChart(chart, datasetIndex = 0, duration = 1500) {
      const data = chart.data.datasets[datasetIndex].data;
      const copy = [...data];
      chart.data.datasets[datasetIndex].data = copy.map(()=>0);
      chart.update();

      let startTime = null;
      function animateFrame(time) {
        if(!startTime) startTime = time;
        let progress = Math.min(1, (time-startTime)/duration);
        chart.data.datasets[datasetIndex].data = copy.map(x=>Math.round(x*progress));
        chart.update();
        if(progress<1) requestAnimationFrame(animateFrame);
      }
      requestAnimationFrame(animateFrame);
    }

    document.addEventListener('DOMContentLoaded', function(){
      const ctx = document.getElementById('achievementsChart').getContext('2d');
      const achievementsChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ['2014', '2015', '2016', '2017', '2018', '2019', '2020', '2021', '2022', '2023', '2024'],
          datasets: [{
            label: 'Milestones Achieved',
            data: [3, 5, 8, 6, 10, 12, 15, 20, 22, 25, 30],
            backgroundColor: [
              '#005f73', '#005f73', '#005f73',
              '#0077b6', '#0077b6', '#00b4d8',
              '#48cae4', '#ffb703', '#feb72b',
              '#ffd166', '#caff70'
            ],
            borderRadius: 16,
            hoverBackgroundColor: '#023047',
            borderSkipped: false,
            barPercentage: 0.75,
            categoryPercentage: 0.7
          }]
        },
        options: {
          responsive: true,
          animation: {
            duration: 0 // We'll animate manually
          },
          plugins: {
            legend: {
              display: false
            },
            title: {
              display: true,
              text: 'Milestones from 2014 to 2024',
              color: '#005f73',
              font: {
                family: 'Poppins',
                weight: 'bold',
                size: 19
              }
            },
            tooltip: {
              backgroundColor: '#005f73',
              titleColor: '#fff',
              bodyColor: '#fff',
              borderColor: '#ffb703',
              borderWidth: 1
            }
          },
          scales: {
            x: {
              grid: {display:false},
              ticks: {
                color: '#525252',
                font: {family:'Poppins',weight:'bold'}
              }
            },
            y: {
              beginAtZero: true,
              grid: {color:'#e9ecef'},
              ticks: {
                color: '#003844',
                font: {family:'Poppins'}
              },
              title: {
                display: true,
                text: 'Achievements',
                color: '#005f73',
                font: {family:'Poppins', weight:600, size:16}
              }
            }
          }
        }
      });
      setTimeout(()=>animateBarChart(achievementsChart), 500);
    });

    // Parallax minor effect on hero
    window.addEventListener('scroll', ()=>{
      const hero = document.querySelector('.hero-section');
      const scrolled = window.scrollY;
      hero.style.backgroundPosition = `center ${scrolled/3}px`;
    });

    // Team member pop effect (ripple)
    document.querySelectorAll('.team-members .member').forEach(member => {
      member.addEventListener('mousedown', e => {
        let ripple = document.createElement('span');
        ripple.className = 'ripple';
        ripple.style.left = `${e.offsetX}px`;
        ripple.style.top = `${e.offsetY}px`;
        member.appendChild(ripple);
        setTimeout(()=>ripple.remove(),600);
      });
    });
  </script>
  <style>
    .ripple {
      position: absolute;
      width: 60px;
      height: 60px;
      background: rgba(0,95,115,0.15);
      border-radius: 100%;
      pointer-events: none;
      transform: translate(-50%, -50%) scale(0);
      animation: ripple-anim .6s cubic-bezier(.32,2,.55,.27) forwards;
      z-index: 1;
    }
    @keyframes ripple-anim {
      to {
        transform: translate(-50%, -50%) scale(2.4);
        opacity: 0;
      }
    }
  </style>

  <?php include '../includes/footer.php'; ?>
</body>
</html>
