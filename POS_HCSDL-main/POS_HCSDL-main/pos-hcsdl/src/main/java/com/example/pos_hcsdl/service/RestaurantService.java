package com.example.pos_hcsdl.service;

import com.example.pos_hcsdl.dto.*;
import com.example.pos_hcsdl.entity.Restaurant;
import com.example.pos_hcsdl.entity.Role;
import com.example.pos_hcsdl.entity.User;
import com.example.pos_hcsdl.exception.BadRequestException;
import com.example.pos_hcsdl.mapper.RestaurantCreateMapper;
import com.example.pos_hcsdl.mapper.RestaurantMapper;
import com.example.pos_hcsdl.mapper.RestaurantSelectMapper;
import com.example.pos_hcsdl.mapper.UserMapper;
import com.example.pos_hcsdl.repository.RestaurantRepository;
import com.example.pos_hcsdl.repository.RoleRepository;
import com.example.pos_hcsdl.repository.UserRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.dao.DataAccessException;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import java.util.List;

@Service
public class RestaurantService {

    @Autowired
    private RestaurantSelectMapper restaurantSelectMapper;
    @Autowired
    private RestaurantCreateMapper restaurantCreateMapper;

    @Autowired
    private RestaurantRepository restaurantRepository;

    @Autowired
    private UserRepository userRepository;

    @Autowired
    private RoleRepository roleRepository;

    @Autowired
    private PasswordEncoder passwordEncoder;

    @Autowired
    private UserMapper userMapper;

    @Autowired
    private RestaurantMapper restaurantMapper;

    public void createStaff(StaffRequest staffRequest, String restaurantId) {

        Role role = roleRepository.findByRoleName("STAFF").orElseThrow(() -> new RuntimeException("Role Not Found"));
        Restaurant restaurant = restaurantRepository.findById(restaurantId)
                .orElseThrow(() -> new BadRequestException("Restaurant Not Found"));
        User user = userMapper.getUser(staffRequest);
        user.setPassword(passwordEncoder.encode(staffRequest.getPassword()));
        user.setRole(role);
        user.setRestaurant(restaurant);

        userRepository.save(user);
    }

    @Transactional
    public RestaurantResponse createRestaurant(RestaurantRequest restaurantRequest) {

        if (userRepository.existsByUsername(restaurantRequest.getUsername())) {
            throw new BadRequestException("Username already exists");
        }

        Role role = roleRepository.findByRoleName("ADMIN_RESTAURANT").orElseThrow(() -> new RuntimeException("Role Not Found"));

        User user = new User();
        user.setUsername(restaurantRequest.getUsername());
        user.setPassword(passwordEncoder.encode(restaurantRequest.getPassword()));
        user.setRole(role);

        User userSaved = userRepository.save(user);


        String id = "";
        try {
            id = restaurantRepository.insertRestaurant(restaurantRequest.getName(),
                    restaurantRequest.getAddress(),
                    restaurantRequest.getDescription(),
                    restaurantRequest.getPhone(), restaurantRequest.getEmail(), restaurantRequest.getImageUrl());
        } catch (DataAccessException ex) {
            System.out.println("Loi khi insert restaurant: " + ex.getMostSpecificCause().getMessage());
            throw new BadRequestException("Khong the tao nha hang: " + ex.getMostSpecificCause().getMessage());
        }
        userRepository.save(userSaved);
        return restaurantCreateMapper.entityToResponse(restaurantRepository.findById(id).orElse(null));
    }

    public List<RestaurantSelect> getRestaurantSelect() {
        return restaurantSelectMapper.entityToResponseList(restaurantRepository.findAll());
    }

    public RestaurantResponse getRestaurantById(String restaurantId) {
        return restaurantMapper.getRestaurantResponse(restaurantRepository.findById(restaurantId)
                .orElseThrow(() -> new BadRequestException("Restaurant Not Found")));
    }

    public List<RestaurantResponse> getRestaurantList() {
        return restaurantMapper.getRestaurantResponseList(restaurantRepository.findRestaurantsOrderByCreatedAtDesc());
    }

    public SummaryResponse getSummary() {
        return restaurantRepository.getSummary();
    }

    public SummaryRestaurantResponse getSummaryRestaurant(String restaurantId) {
        return restaurantRepository.getSummaryRestaurant(restaurantId);
    }
}
