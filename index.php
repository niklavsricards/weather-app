<?php

require_once 'vendor/autoload.php';

use App\Request;
use App\ForecastData;

$apiKey = '7cffa62b1dfb4530a5765821212809';

if (isset($_GET['submit'])) {
    $request = new Request(
        $apiKey,
        $_GET['location'],
        $_GET['days']
    );

    $response = $request->response();

    $data = new ForecastData($response);
}

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU"
      crossorigin="anonymous">

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
      integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer" />

<h4>Weather Forecast App</h4>

<form action="/" method="get">
    <div class="mb-3 w-25">
        <label for="location" class="form-label">Location: Enter city name</label>
        <input type="text" class="form-control" id="location" name="location">
    </div>

    <div class="mb-3 w-25">
        <label for="select">Select number of days: </label>
        <select name="days" class="form-select">
            <option selected value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
        </select>
    </div>

    <button type="submit" name="submit" class="btn btn-primary">See weather forecast</button>
</form>

<?php if (isset($data)): ?>
    <h3>Current weather: </h3>
    <div class="col-12 col-md-4 col-sm-12 col-xs-12">
        <div class="card p-4">
            <div class="d-flex">
                <h6 class="flex-grow-1"><?php echo $data->getCity() ?></h6>
                <h6 class="flex-grow-1"><?php echo $data->getCountry() ?></h6>
                <h6><?php echo $data->getLocalTime() ?></h6>
            </div>
            <div class="d-flex flex-column temp mt-5 mb-3">
                <h1 class="mb-0 font-weight-bold" id="heading"> <?php echo $data->getCurrentTemp()?>° C</h1>
                <span class="small grey"><?php echo $data->getCurrentCondition() ?></span>
            </div>
            <div class="d-flex">
                <div class="temp-details flex-grow-1">
                    <p class="my-1"><img src="https://i.imgur.com/B9kqOzp.png" height="17px" alt="">
                        <span> <?php echo $data->getCurrentWindSpeed() ?> km/h</span></p>
                    <p class="my-1"><i class="fa fa-tint mr-2" aria-hidden="true"></i>
                        <span> <?php echo $data->getCurrentHumidity()?>%</span></p>
                    <p class="my-1"><img src="https://i.imgur.com/wGSJ8C5.png" height="17px" alt="">
                        <span> UV <?php echo $data->getCurrentUV() ?></span></p>
                </div>
                <div> <img src="<?php echo $data->getCurrentConditionIcon() ?>" width="100px" alt=""> </div>
            </div>
        </div>
    </div>

    <br>

    <h3>Daily Forecast: </h3>

    <?php foreach ($data->getAllDays() as $key => $value): ?>
        <div class="col-12 col-md-4 col-sm-12 col-xs-12">
            <div class="card p-4">
                <div class="d-flex">
                    <h6 class="flex-grow-1">Daily high <?php echo $data->getDailyMax($key) ?>° C</h6>
                    <h6 class="flex-grow-1">Daily low <?php echo $data->getDailyMin($key) ?>° C</h6>
                    <h6><?php ?></h6>
                </div>
                <div class="d-flex flex-column temp mt-5 mb-3">
                    <span class="small grey">Daily average</span>
                    <h1 class="mb-0 font-weight-bold" id="heading"> <?php echo $data->getDailyAverageTemp($key) ?>° C</h1>
                    <span class="small grey"><?php echo $data->getDailyCondition($key) ?></span>
                </div>
                <div class="d-flex">
                    <div class="temp-details flex-grow-1">
                        <p class="my-1"><img src="https://i.imgur.com/B9kqOzp.png" height="17px" alt="">
                            <span> <?php echo $data->getWindSpeed($key) ?> km/h</span></p>
                        <p class="my-1"><i class="fa fa-tint mr-2" aria-hidden="true"></i>
                            <span> <?php echo $data->getAverageHumidity($key)?>%</span></p>
                        <p class="my-1"><img src="https://i.imgur.com/wGSJ8C5.png" height="17px" alt="">
                            <span> UV <?php echo $data->getDailyUv($key) ?></span></p>
                    </div>
                    <div> <img src="<?php echo $data->getDailyIcon($key) ?>" width="100px" alt=""> </div>
                </div>
            </div>
        </div>
        <br>
    <?php endforeach; ?>
<?php endif; ?>