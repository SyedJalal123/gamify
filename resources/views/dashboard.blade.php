<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sell Game Currency</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #fff;
      font-family: 'Poppins', sans-serif;
      padding: 20px;
    }
    .custom-container {
      max-width: 750px;
      margin: 0 auto;
    }
    .main-card {
      border-radius: 16px;
      overflow: hidden;
    }
    .card-section {
      background: #ffffff;
      border: 1px solid #e2e2e2;
      border-radius: 16px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.06);
      padding: 25px;
      margin-bottom: 20px;
    }
    h1 {
      font-weight: 700;
      font-size: 28px;
      margin-bottom: 30px;
      text-align: center;
    }
    .form-label {
      font-weight: 600;
      font-size: 15px;
      margin-bottom: 6px;
    }
    small, .form-text {
      font-size: 12px;
      color: #6c757d;
      font-weight: 400;
    }
    .input-group-text {
      min-width: 50px;
      justify-content: center;
      background-color: #f1f1f1;
      border: none;
      font-weight: 600;
    }
    .btn-minus, .btn-plus {
      width: 36px;
      background-color: #f1f1f1;
      border: none;
      font-weight: bold;
      font-size: 20px;
      border-radius: 8px;
    }
    .btn-minus:hover, .btn-plus:hover {
      background-color: #d6d6d6;
    }
    .btn-delete {
      background-color: #dc3545;
      border: none;
      padding: 6px 10px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
    }
    .btn-delete:hover {
      background-color: #ffffff;
      border: 1px solid #dc3545;
    }
    .btn-delete:hover i {
      color: #dc3545;
    }
    .btn-delete i {
      font-size: 18px;
      color: #fff;
      transition: color 0.3s ease;
    }
    button, input, select, textarea {
      font-size: 14px;
    }
    @media (max-width: 576px) {
      .row.g-2 > div {
        flex: 0 0 100%;
        max-width: 100%;
      }
    }
  </style>
</head>
<body>

<div class="custom-container">
  <div class="main-card">

    <h1>Sell Game Currency</h1>

    <!-- Item Section -->
    <div class="card-section">
      <label class="form-label">Your item</label>
      <div class="d-flex align-items-center">
        <img src="{{ asset('uploads/games/riot-points.webp') }}" alt="Game Image" style="width: 90px; height: auto; border-radius: 8px;">
        <div class="ms-3">
          <div class="fw-bold">Albion Asia</div>
          <div class="text-muted small">Silver</div>
        </div>
      </div>
    </div>

    <!-- Description -->
    <div class="card-section">
      <label class="form-label">Description (Optional)</label>
      <textarea class="form-control" rows="4" placeholder="Type here..."></textarea>
      <small class="form-text">The listing title and description must be accurate and informative. Misleading description violates Seller Rules.</small>
    </div>

    <!-- Delivery Time -->
    <div class="card-section">
      <label class="form-label">Guaranteed Delivery Time</label>
      <select class="custom-select">
        <option selected>Choose</option>
        <option>15 minutes</option>
        <option>30 minutes</option>
        <option>1 hour</option>
        <option>2 hours</option>
      </select>
    </div>

    <!-- Quantity Section -->
    <div class="card-section">
      <label class="form-label">Quantity</label>
      <div class="row g-2">
        <div class="col-md-6">
          <div class="input-group">
            <button class="btn btn-minus" type="button">-</button>
            <input type="number" class="form-control text-center" value="0" min="0">
            <button class="btn btn-plus" type="button">+</button>
            <span class="input-group-text">M</span>
          </div>
          <small>Total Quantity Available</small>
        </div>
        <div class="col-md-6">
          <div class="input-group">
            <button class="btn btn-minus" type="button">-</button>
            <input type="number" class="form-control text-center" value="1" min="1">
            <button class="btn btn-plus" type="button">+</button>
            <span class="input-group-text">M</span>
          </div>
          <small>Minimum Offer Quantity</small>
        </div>
      </div>
    </div>

    <!-- Price Section -->
    <div class="card-section">
      <label class="form-label">Price per 1M</label>
      <div class="input-group">
        <input type="number" class="form-control" placeholder="Price">
        <span class="input-group-text">$ USD</span>
      </div>
    </div>

    <!-- Volume Discount -->
    <div class="card-section">
      <label class="form-label">Volume Discount</label>
      <div id="discount-container">
        <div class="row g-2 align-items-center mb-2 discount-row">
          <div class="col-md-5">
            <div class="input-group">
              <button class="btn btn-minus" type="button">-</button>
              <input type="number" class="form-control text-center" value="0" min="0">
              <button class="btn btn-plus" type="button">+</button>
              <span class="input-group-text">M</span>
            </div>
          </div>
          <div class="col-md-5">
            <div class="input-group">
              <button class="btn btn-minus" type="button">-</button>
              <input type="number" class="form-control text-center" value="0" min="0" max="100">
              <button class="btn btn-plus" type="button">+</button>
              <span class="input-group-text">%</span>
            </div>
          </div>
          <div class="col-md-2 text-center">
            <button type="button" class="btn btn-delete delete-row"><i class="fas fa-trash"></i></button>
          </div>
        </div>
      </div>
      <button type="button" class="btn btn-secondary btn-sm mt-2" id="addRow">+ Add row</button>
    </div>

    <!-- Fee Structure -->
    <div class="card-section">
      <label class="form-label">Fee Structure</label>
      <div class="p-3 bg-light rounded">
        <div class="small">Flat fee (per purchase): <strong>$0.00 USD</strong></div>
        <div class="small">Percentage fee (per purchase): <strong>5% of Price</strong></div>
      </div>
    </div>

    <!-- Terms and Place Offer -->
    <div class="card-section">
      <div class="form-check mb-2">
        <input class="form-check-input" type="checkbox" id="termsService">
        <label class="form-check-label" for="termsService">
          I have read and agree to the <a href="#">Terms of Service</a>.
        </label>
      </div>
      <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" id="sellerRules">
        <label class="form-check-label" for="sellerRules">
          I have read and agree to the <a href="#">Seller Rules</a>.
        </label>
      </div>
      <button class="btn btn-dark w-100">Place Offer</button>
    </div>

  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
  function updatePlusMinus() {
    document.querySelectorAll('.btn-minus').forEach(btn => {
      btn.onclick = function() {
        const input = this.nextElementSibling;
        if (input.value > input.min) {
          input.value--;
        }
      };
    });
    document.querySelectorAll('.btn-plus').forEach(btn => {
      btn.onclick = function() {
        const input = this.previousElementSibling;
        input.value++;
      };
    });
    document.querySelectorAll('.delete-row').forEach(btn => {
      btn.onclick = function() {
        this.closest('.discount-row').remove();
      };
    });
  }

  updatePlusMinus();

  document.getElementById('addRow').addEventListener('click', function() {
    const container = document.getElementById('discount-container');
    const row = document.createElement('div');
    row.className = 'row g-2 align-items-center mb-2 discount-row';
    row.innerHTML = `
      <div class="col-md-5">
        <div class="input-group">
          <button class="btn btn-minus" type="button">-</button>
          <input type="number" class="form-control text-center" value="0" min="0">
          <button class="btn btn-plus" type="button">+</button>
          <span class="input-group-text">M</span>
        </div>
      </div>
      <div class="col-md-5">
        <div class="input-group">
          <button class="btn btn-minus" type="button">-</button>
          <input type="number" class="form-control text-center" value="0" min="0" max="100">
          <button class="btn btn-plus" type="button">+</button>
          <span class="input-group-text">%</span>
        </div>
      </div>
      <div class="col-md-2 text-center">
        <button type="button" class="btn btn-delete delete-row"><i class="fas fa-trash"></i></button>
      </div>
    `;
    container.appendChild(row);
    updatePlusMinus();
  });
</script>

</body>
</html>
