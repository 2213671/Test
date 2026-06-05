package com.example.pos_hcsdl.service;

import com.example.pos_hcsdl.dto.StaffResponse;
import com.example.pos_hcsdl.entity.Restaurant;
import com.example.pos_hcsdl.exception.BadRequestException;
import com.example.pos_hcsdl.mapper.UserMapper;
import com.example.pos_hcsdl.repository.RestaurantRepository;
import com.example.pos_hcsdl.repository.UserRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class UserService {

    @Autowired
    private UserRepository userRepository;

    @Autowired
    private RestaurantRepository restaurantRepository;

    @Autowired
    private UserMapper userMapper;

    public List<StaffResponse> getStaffs(String restaurantId) {
        Restaurant restaurant = restaurantRepository.findById(restaurantId)
                .orElseThrow(() -> new BadRequestException("Restaurant not found"));

        return userMapper.getStaffResponseList(userRepository.findAllByRestaurant(restaurant));
    }
}
