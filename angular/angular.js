angular.module('thekotte', [])
	.controller('index', ["$scope", function($scope){
		$scope.message = "Min flickvän är en räv"; 
	}]);

angular.module('snopp', [])
	.controller('personController', ["$scope", function($scope){
		$scope.firstName = "Peter";
		$scope.lastName = "Lund";
	}]);

