
  // Initialize when DOM is fully loaded
  document.addEventListener('DOMContentLoaded', () => {
      console.log('DOM loaded, initializing table scripts');

      // Search Functionality
      const searchInput = document.getElementById('table-search');
      const table = document.getElementById('data-table');
      let rows = table ? table.querySelectorAll('tbody tr') : [];

      if (!searchInput) {
          console.error('Search input (#table-search) not found');
          return;
      }
      if (!table) {
          console.error('Table (#data-table) not found');
          return;
      }
      if (rows.length === 0) {
          console.warn('No rows found in table body');
      }

      searchInput.addEventListener('input', () => {
          const searchTerm = searchInput.value.trim().toLowerCase();
          console.log('Search term:', searchTerm);

          rows.forEach((row, index) => {
              const cells = row.querySelectorAll('td:not(.action-cell)');
              const rowText = Array.from(cells)
                  .map(cell => cell.textContent.trim().toLowerCase())
                  .join(' ');
              
              const isMatch = searchTerm === '' || rowText.includes(searchTerm);
              row.style.display = isMatch ? '' : 'none';
              console.log(`Row ${index + 1} text: "${rowText}", Match: ${isMatch}`);
          });
      });

    

      // Helper function to get column index (1-based for nth-child)
      function getColumnIndex(column) {
          const columns = ['id', 'name', 'email', 'role'];
          const index = columns.indexOf(column) + 1;
          if (index === 0) {
              console.error('Invalid column:', column);
          }
          return index;
      }
  });
