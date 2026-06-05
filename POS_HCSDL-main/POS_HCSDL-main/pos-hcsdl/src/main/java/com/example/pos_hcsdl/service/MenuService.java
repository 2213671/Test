package com.example.pos_hcsdl.service;

import com.example.pos_hcsdl.dto.MenuRequest;
import com.example.pos_hcsdl.dto.MenuResponse;
import com.example.pos_hcsdl.entity.Menu;
import com.example.pos_hcsdl.entity.Restaurant;
import com.example.pos_hcsdl.enums.Status;
import com.example.pos_hcsdl.exception.BadRequestException;
import com.example.pos_hcsdl.mapper.MenuCreateMapper;
import com.example.pos_hcsdl.mapper.MenuMapper;
import com.example.pos_hcsdl.repository.MenuRepository;
import com.example.pos_hcsdl.repository.RestaurantRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class MenuService {

    @Autowired
    private MenuMapper menuMapper;

    @Autowired
    private MenuRepository menuRepository;

    @Autowired
    private RestaurantRepository restaurantRepository;

    public MenuResponse createMenu(MenuRequest menuRequest, String restaurantId) {
        Restaurant restaurant = restaurantRepository.findById(restaurantId)
                .orElseThrow(() -> new BadRequestException("restaurant not found"));
        Menu menu = menuMapper.getMenu(menuRequest);
        menu.setRestaurant(restaurant);
        menu.setStatus("ACTIVE");
        return menuMapper.getMenuResponse(menuRepository.save(menu));
    }

    public MenuResponse getMenuById(String id) {
        return menuMapper.getMenuResponse(menuRepository.findById(id).orElseThrow(() -> new RuntimeException("Menu not found")));
    }

    public List<MenuResponse> getMenusByRestaurant(String restaurantId) {
        Restaurant restaurant = restaurantRepository.findById(restaurantId)
                .orElseThrow(() -> new BadRequestException("restaurant not found"));

        return menuMapper.getMenuResponseList(menuRepository.findAllByRestaurant(restaurant));
    }

    public MenuResponse updateMenu(String menuId, MenuRequest menuRequest) {
        Menu menu = menuRepository.findById(menuId)
                .orElseThrow(() -> new BadRequestException("menu not found"));
        menu.setName(menuRequest.getName());
        menu.setDescription(menuRequest.getDescription());
        return menuMapper.getMenuResponse(menuRepository.save(menu));
    }
}
