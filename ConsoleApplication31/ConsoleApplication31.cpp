#include <iostream>
#include <string>
#include <vector>
#include <sstream>

struct GPSData {
	double latitude;
	double longitude;
	double speed;
	int fixStatus; // 0: no fix, 1: GPS fix, 2: DGPS fix
};

bool ParseGPGGA(const std::string& sentence, GPSData& data) {
	std::istringstream stream(sentence);
	std::string token;

	// Split the NMEA sentence into tokens
	std::vector<std::string> tokens;
	while (std::getline(stream, token, ',')) {
		tokens.push_back(token);
	}

	if (tokens.size() < 14 || tokens[0] != "$GPGGA") {
		return false; // Invalid sentence or wrong sentence type
	}

	// Parse latitude and longitude
	double latitude = std::stod(tokens[2]);
	double longitude = std::stod(tokens[4]);

	// Parse speed
	double speed = std::stod(tokens[7]);

	// Parse fix status
	int fixStatus = std::stoi(tokens[6]);

	data.latitude = latitude;
	data.longitude = longitude;
	data.speed = speed;
	data.fixStatus = fixStatus;

	return true;
}

int main() {
	std::string nmeaSentence = "$GPGGA,123519,4807.038,N,01131.000,E,1,08,0.9,545.4,M,46.9,M,,*47";

	GPSData gpsData;

	if (ParseGPGGA(nmeaSentence, gpsData)) {
		std::cout << "Latitude: " << gpsData.latitude << " degrees" << std::endl;
		std::cout << "Longitude: " << gpsData.longitude << " degrees" << std::endl;
		std::cout << "Speed: " << gpsData.speed << " knots" << std::endl;
		std::cout << "Fix Status: " << gpsData.fixStatus << std::endl;
	}
	else {
		std::cout << "Invalid NMEA sentence or unsupported type." << std::endl;
	}

	return 0;
}
