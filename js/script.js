const form = document.getElementById('empform');

  form.addEventListener('submit', (event) => {
    const salary = document.getElementById('salary').value;
    const grad = document.getElementById('grad').value;
    const num = /^\d+$/

    if (!salary.match(num)) {
      alert('Please Enter Number In Employee Salary Field');
      event.preventDefault(); // prevent form submission
    }

    if (!grad.match(num)) {
      alert('Please Enter Number In Graduation Percentile Field');
      event.preventDefault(); // prevent form submission
    }

  });
