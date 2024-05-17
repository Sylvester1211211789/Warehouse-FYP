#include <iostream>
#include <chrono>
#include <ctime>
#include <iomanip>

int main() {
    // Get the current time
    auto now = std::chrono::system_clock::now();
    std::time_t end_time = std::chrono::system_clock::to_time_t(now);

    // Get the user input for the date
    std::tm start_date = {};
    std::cout << "Enter the date (DD-MM-YYYY): ";
    std::cin >> std::get_time(&start_date, "%d-%m-%Y");
    std::time_t start_time = std::mktime(&start_date);

    // Calculate the difference in seconds
    std::chrono::seconds difference = std::chrono::seconds(end_time - start_time);

    // Convert seconds to days
    int days = difference.count() / (60 * 60 * 24);

    // Output the result
    std::cout << "Number of days between " << std::put_time(&start_date, "%d-%m-%Y") << " and today: " << days << std::endl;

    return 0;
}
