const body = document.querySelector('body'),
      sidebar = document.querySelector('.sidebar'),
      toggle = document.querySelector('.toggle'),
      searchBox = document.querySelector('.search-box');
      // toggleItem = document.querySelector('.toggle-item');

      toggle.addEventListener('click', () =>{
        sidebar.classList.toggle("close");
      });

   