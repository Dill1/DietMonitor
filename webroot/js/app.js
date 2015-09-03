/**
 * 
 */

var baseUrl = "http://localhost:8765";

var app = angular.module('dmApp', []);

console.log("about to define the controller");

app.controller('appCtrl', function($scope, $http) {
	$scope.newField = {};
	$scope.edit = {};
	getTodaysTotalCalories();
	getMeals();

	function clearMessages() {
		$scope.addNewMealError = undefined;
		$scope.editMealError = undefined;
	}

	function showModal(b) {
		$scope.showModal = (b === undefined ? true : b);
	}
	
	function getTodaysTotalCalories() {
		clearMessages();
		showModal();
		$http.defaults.headers.common.Accept = "application/json";
		$http.get(baseUrl + "/meals/range" 
				+ "?from_date=" + seconds(new Date()) 
				+ "&to_date=" + seconds(new Date()))
				.success(function(response) {
					$scope.todaysTotalCalories = addCalories(response.meals);
					console.log("finished successfully for todays meals: " + response.meals);
					showModal(false);
				}).error(function(data, status, headers, config) {
					console.log("problem loading: " + status);
					showModal(false);
				});
	};

	function addCalories(meals) {
		var total = 0;
		for (var i in meals) {
			total += meals[i].calories;
		}
		
		return total;
	}
	
	function getMeals() {
		clearMessages();
		showModal();
		$http.defaults.headers.common.Accept = "application/json";
		$http.get(baseUrl + "/meals/range" 
				+ "?from_date=" + seconds($scope.fromDate) 
				+ "&to_date=" + seconds($scope.toDate)
				+ "&from_time=" + seconds($scope.fromTime) 
				+ "&to_time=" + seconds($scope.toTime))
				.success(function(response) {
					$scope.meals = response.meals;
					console.log("finished successfully for meals between " + $scope.fromDate + " and " + $scope.toDate +": " + response.meals);
					showModal(false);
				}).error(function(data, status, headers, config) {
					console.log("problem loading: " + status);
					showModal(false);
				});
	};

	function getAllMeals() {
		$scope.fromDate = null;
		$scope.toDate = null;
		$scope.fromTime= null;
		$scope.toTime = null;
		getMeals();
	};

	function getDateParameters(odate) {
		var date = {year: odate.getFullYear(), month: odate.getMonth()+1, day: odate.getDate()};
		return date;
	}

	function getTimeParameters(otime) {
		var time = {hour: otime.getHours(), minute: otime.getMinutes()};
		return time;
	}
	
	function addNewMeal() {
		clearMessages();
		if (isEmpty($scope.newField.date) || isEmpty($scope.newField.time) || isEmpty($scope.newField.description) || isEmpty($scope.newField.calories)) {
			$scope.addNewMealError = "All fields are required";
			console.log("missing fields for adding");
			return;
		}

		showModal();
		$http.post(baseUrl + "/meals/add", {
			calories: $scope.newField.calories,
			description: $scope.newField.description.trim(),
			date: getDateParameters($scope.newField.date),
			time: getTimeParameters($scope.newField.time)
		}).success(function(response) {
			console.log("finished successfully adding meal: " + response.meals);
			$scope.meals = response.meals;
			$scope.newField = {};
			showModal(false);
			getTodaysTotalCalories();
		}).error(function(data, status, headers, config) {
			console.log("problem adding new meal");
			showModal(false);
		});
	}

	function editMeal(meal) {
		clearMessages();
		$scope.edit = {id: meal.id, description : meal.description, calories: meal.calories};
		$scope.edit.date = new Date(meal.date);
		$scope.edit.time = new Date(meal.time);
	}
	
	function cancelEdit() {
		clearMessages();
		$scope.edit = {};
	}
	
	function saveMeal() {
		clearMessages();

		if (isEmpty($scope.edit.description) || isEmpty($scope.edit.calories)) {
			$scope.editMealError = "All fields are required";
			console.log("missing fields for editing");
			return;
		}

		showModal();
		$http.put(baseUrl + "/meals/edit/" + $scope.edit.id, {
			description: $scope.edit.description.trim(), 
			calories: $scope.edit.calories,
			date: getDateParameters($scope.edit.date),
			time: getTimeParameters($scope.edit.time)
		}).success(function(response) {
			console.log("finished successfully editing meal: " + response.meals);
			$scope.meals = response.meals;
			getTodaysTotalCalories();
			cancelEdit();
			showModal(false);
		}).error(function(data, status, headers, config) {
			console.log("problem editing the meal with id " + $scope.edit.id);
			showModal(false);
		});
	}
	
	function deleteMeal(meal) {
		clearMessages();
		// TODO violates MVC
		if (! confirm("Would you like to delete " + meal.description + "?")) {
			console.log("Canceled by the user");
			return;
		}
		
		showModal();
		$http.post(baseUrl + "/meals/delete/" + meal.id)
		.success(function(response) {
			console.log("finished successfully deleting meal: " + response.meals);
			$scope.meals = response.meals;
			showModal(false);
			getTodaysTotalCalories();
		}).error(function(data, status, headers, config) {
			console.log("problem deleting meal");
			showModal(false);
		});
	}

	function seconds(date) {
		if (date == null) {
			return "";
		}
		console.log("date: " + date + ", seconds: " + (date.getTime() + "").slice(0, -3));
		return (date.getTime() + "").slice(0, -3);
	}

	function isEmpty(s) {
		if (s == null) return true;
		try {s.trim();} catch(e) {};
		if (s.length == 0) return true;
		return false;
	}
	
	$scope.addNewMeal = addNewMeal;
	$scope.deleteMeal = deleteMeal;
	$scope.editMeal = editMeal;
	$scope.saveMeal = saveMeal;
	$scope.cancelEdit = cancelEdit;
	
	$scope.getMeals = getMeals;
	$scope.getAllMeals = getAllMeals;
	$scope.isEmpty = isEmpty;
});

console.log("finished defining the controller");

// routing
/*
 * dmApp.config(function($routeProvider, $httpProvider) { $routeProvider
 * .when('/meals', {templateUrl: 'partials/posts.html', controller:
 * 'PostListCtrl'}) .when('/meals/add', {templateUrl: 'partials/new-post.html',
 * controller: 'NewPostCtrl'}) .when('/meals/edit/:id', {templateUrl:
 * 'partials/edit-post.html', controller: 'EditPostCtrl'})
 * .otherwise({redirectTo : '/'});
 * 
 * });
 */