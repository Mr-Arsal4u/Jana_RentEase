<style>
    .currency-options {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .currency-options label {
        margin-right: 10px;
    }

    .success-container {
        text-align: center;
        padding: 20px;
    }

    .success-image {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 5px solid green;
        display: inline-block;
        margin-bottom: 10px;
    }

    .tick-icon {
        font-size: 28px;
        line-height: 40px;
        vertical-align: middle;
    }
</style>
<div class="step" id="step5">
    <h3 class="mb-3">Step 5</h3>
    <div class="row g-3">
        <div class="col-md-12">
            <div class="form-group">
                <label>Please Select Desired Currency for Property</label>
                @foreach ($currencies as $currency)
                    <div class="currency-options">
                        <div class="form-check form-check-inline currency">
                            <input class="form-check-input" type="radio" name="currency" id="currency_id"
                                value="{{ $currency->id }}" required>
                            <label class="form-check-label" for="currencyPKR">{{ $currency->code }}</label>
                        </div>
                    </div>
                @endforeach

            </div>
            <div id="amountContainer" class="col-md-6" style="display: none">
                <label for="desiredAmount" class="form-label">Desired Amount for Property</label>
                <input oninput="loadFee()" type="number" class="form-control form-control-sm" id="desiredAmount"
                    required>
            </div>
        </div>
        <div id="contract-container">

        </div>

    </div>
    <div class="d-flex justify-content-between mt-4">
        <button type="button" class="btn btn-secondary" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
        <button type="button" class="btn btn-primary" id="submitBtn" disabled>Save </button>
    </div>
</div>
<div style="display: none" id="success-container" class="success-container">
    {{-- <span class="tick-icon">&#10004;</span> --}}
    <img src="https://static.vecteezy.com/system/resources/previews/009/663/249/original/tick-icon-transparent-free-png.png" alt="Tick" class="success-image">
    <p>Application saved successfully!</p>
</div>
