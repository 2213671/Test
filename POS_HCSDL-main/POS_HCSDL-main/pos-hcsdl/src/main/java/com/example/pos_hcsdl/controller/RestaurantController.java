package com.example.pos_hcsdl.controller;

import com.example.pos_hcsdl.dto.*;
import com.example.pos_hcsdl.entity.User;
import com.example.pos_hcsdl.service.RestaurantService;
import com.example.pos_hcsdl.service.UserService;
import io.swagger.v3.oas.annotations.tags.Tag;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.access.prepost.PreAuthorize;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@Tag(name = "2. Restaurant Management")
@RestController
@RequestMapping("/restaurant")
public class RestaurantController {
    @Autowired
    private RestaurantService restaurantService;

    @Autowired
    private UserService userService;


    @PostMapping("/create")
    public RestaurantResponse createRestaurant(@RequestBody RestaurantRequest restaurantRequest) {
        return restaurantService.createRestaurant(restaurantRequest);
    }

    @PostMapping("/create-staff")
    public void createUser(@RequestBody StaffRequest staffRequest,
                           @RequestHeader(name = "X-Restaurant-Id", required = true) String restaurantId ) {
        restaurantService.createStaff(staffRequest,restaurantId);
    }

    @GetMapping("/{id}/staffs")
    public List<StaffResponse> getStaffs(
            @PathVariable String id)
    {
        return userService.getStaffs(id);
    }

//    @PreAuthorize("hasRole('STAFF')")
    @GetMapping("/select-list")
    public List<RestaurantSelect> selectRestaurantList() {
        return restaurantService.getRestaurantSelect();
    }

    @GetMapping("/{id}")
    public RestaurantResponse getRestaurantById(@PathVariable String id) {
        return restaurantService.getRestaurantById(id);
    }

    @GetMapping("/list")
    public List<RestaurantResponse> getRestaurantList() {
        return restaurantService.getRestaurantList();
    }

    @GetMapping("/summary")
    public SummaryResponse getSummary() {
        return restaurantService.getSummary();
    }

    @GetMapping("/{id}/summary")
    public SummaryRestaurantResponse getSummaryRestaurant(@PathVariable String id) {
        return restaurantService.getSummaryRestaurant(id);
    }
}
