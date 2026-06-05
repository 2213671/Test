package com.example.pos_hcsdl.service;

import com.example.pos_hcsdl.dto.OptionRequest;
import com.example.pos_hcsdl.dto.OptionResponse;
import com.example.pos_hcsdl.entity.Option;
import com.example.pos_hcsdl.entity.Restaurant;
import com.example.pos_hcsdl.exception.BadRequestException;
import com.example.pos_hcsdl.mapper.OptionMapper;
import com.example.pos_hcsdl.repository.OptionRepository;
import com.example.pos_hcsdl.repository.RestaurantRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class OptionService {

    @Autowired
    private OptionRepository optionRepository;

    @Autowired
    private RestaurantRepository restaurantRepository;

    @Autowired
    private OptionMapper optionMapper;

    public OptionResponse createOption(OptionRequest optionRequest, String restaurantId) {
        Restaurant restaurant = restaurantRepository.findById(restaurantId)
                .orElseThrow(() -> new BadRequestException("restaurant not found"));

        Option topping = optionMapper.getOption(optionRequest);
        topping.setRestaurant(restaurant);
        topping.setStatus("ACTIVE");

        return optionMapper.getOptionResponse(optionRepository.save(topping));
    }

    public List<OptionResponse> getOptionsByRestaurant(String restaurantId) {
        Restaurant restaurant = restaurantRepository.findById(restaurantId)
                .orElseThrow(() -> new BadRequestException("restaurant not found"));
        return optionMapper.getOptionResponseList(optionRepository.findAllByRestaurant(restaurant));
    }

    public OptionResponse updateOption(String optionId, OptionRequest optionRequest) {
        Option option = optionRepository.findById(optionId)
                .orElseThrow(() -> new BadRequestException("option not found"));
        option.setName(optionRequest.getName());
        option.setPrice(optionRequest.getPrice());
        option.setRequired(optionRequest.getRequired());
        return optionMapper.getOptionResponse(optionRepository.save(option));
    }
}
